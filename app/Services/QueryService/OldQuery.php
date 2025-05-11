<?php

namespace App\Services\QueryService;

class OldQuery
{
    protected $request;
    protected $paginate;
    protected $models = [];

    public function run($request)
    {
        $this->request = $request;

        $query = json_decode($request->input("query"));

        foreach ($query as $modelAlias => $value) {
            $result[$modelAlias] = $this->runQuery(
                $this->models[$modelAlias],
                $value
            );
        }
        return $result;
    }

    public function runQuery($modelClass, $query)
    {
        // Evaluate select.
        $model = new $modelClass();

        $result = $this->evaluateQuery($model, $query);

        if (property_exists($query, "rels")) {
            $this->evaluateRels($result, $query->rels);
        }

        if (property_exists($query, "computed")) {
            $this->evaluateComputed($result, $query->computed);
        }

        if (
            property_exists($query, "paginate") &&
            !property_exists($query, "limit")
        ) {
            // work on pagination here.
            return array_merge($this->paginate->toArray(), [
                "data" => $result,
            ]);
        } else {
            return $result;
        }
    }

    public function evaluateQuery($result, $query)
    {
        // Evaluate select
        if (property_exists($query, "select")) {
            $result = $result->select(...$query->select);
        } else {
            $result = $result->select("*");
        }

        // Evaluates clauses
        // clauses = [
        //     { name: "where", value: ["attribute", "operator", "value"] },
        //     { name: "where", value: [{ name: "Where", value:[] }, { name: "orWhere", value:[] } }, // with subquery
        // ];
        if (property_exists($query, "clauses")) {
            foreach ($query->clauses as $clause) {
                // $clause->name is string
                // $value->value is a array
                $this->evaluateClause($result, $clause->name, $clause->value);
            }
        }

        //Evaluate order.
        // order: [
        //     [attributeName, asc],
        //     [attributeName, desc]
        // ]
        if (property_exists($query, "order")) {
            foreach ($query->order as $item) {
                $result = $result->orderBy(...$item);
            }
        }

        // Evaluate pagination and limit.
        // Here we sould return the result.
        if (property_exists($query, "limit")) {
            if ((int) $query->limit == 1) {
                return $result->first();
            } else {
                return $result->limit($query->limit)->get();
            }
        }

        // Evaluate pagination.
        // We shouldn't have paginate and limit
        // And error will occurs otherwise.
        if (property_exists($query, "paginate")) {
            $this->request->query->set("page", $query->paginate[0]);
            $this->paginate = $result->paginate($query->paginate[1]);
            return $this->paginate->getCollection();
        }

        // We have no result we get the result.
        return $result->get();
    }


    /**
     * Recursively evaluates query clauses, applying them to the query builder.
     *
     * @param \Illuminate\Database\Query\Builder $result    The query builder instance.
     * @param string                            $clauseName The clause method name (e.g., 'where', 'orWhere').
     * @param array                             $value      The clause arguments. If $value[0] is an object, it contains sub-clauses.
     */
    function evaluateClause($result, $clauseName, $value)
    {
        // Check if $value[0] is an object, indicating that $value contains nested sub-clauses.
        if (is_object($value[0])) {
            // Recursively apply each sub-clause within the provided closure.
            $result = $result->$clauseName(function ($q) use ($value) {
                foreach ($value as $clause) {
                    // Recursively evaluate each sub-clause.
                    $this->evaluateClause($q, $clause->name, $clause->value);
                }
            });
        } else {
            // Apply the clause with its arguments directly to the query builder.
            $result = $result->$clauseName(...$value);
        }
    }

    function load($model, $key, $value)
    {
        // A relation without sub relations.
        if (is_string($value)) {
            $model->$key;
        }

        // A relation with sub relations.
        if (is_object($value)) {
            $this->loadRecursif($model, $key, $value);
        }
    }

    function evaluateRels($model, $rels)
    {
        if ($this->objectIsModel($model)) {
            // relation props
            foreach ($rels as $key => $value) {
                $this->load($model, $key, $value);
            }
            // computed props.
        }

        if ($this->objectIsCollection($model)) {
            $model->map(function ($element) use ($rels) {
                foreach ($rels as $key => $value) {
                    $this->load($element, $key, $value);
                }
                return $element;
            });
        }
    }

    function evaluateComputed($model, $computed)
    {
        // Evaluate only if the vue is and array.
        if ($this->objectIsModel($model)) {
            foreach ($computed as $name => $value) {
                if (is_array($value)) {
                    $model->$name = $model->$name(...$value);
                }
            }
        }

        if ($this->objectIsCollection($model)) {
            $model->map(function ($element) use ($computed) {
                foreach ($computed as $name => $value) {
                    if (is_array($value)) {
                        $element->$name = $element->$name(...$value);
                    }
                }
            });
        }
    }

    function loadRecursif($model, $rel, $subQuery)
    {
        // If the prop correspond to a relation that return is a model
        // we juste check select and props.
        if ($this->objectIsModel($model->$rel)) {
            // Select is always apply.
            if (property_exists($subQuery, "select")) {
                // $model->
                $this->applySelect($model->$rel, $subQuery->select);
            }
        }

        // If the result is a collection. we can evaluate also clauses
        if ($this->objectIsCollection($model->$rel)) {
            if (!$model->$rel->isEmpty()) {
                $model->setRelation(
                    $rel,
                    $this->evaluateQuery($model->$rel->toQuery(), $subQuery)
                );
            }
        }

        // Evaluate props of the current loading node.
        if (property_exists($subQuery, "rels")) {
            $this->evaluateRels($model->$rel, $subQuery->rels);
        }

        if (property_exists($subQuery, "computed")) {
            $this->evaluateComputed($model->$rel, $subQuery->computed);
        }
    }

    function objectIsModel($object)
    {
        if($object == null)
            return false;
        return in_array("Models", explode("\\", get_class($object)));
    }

    function objectIsCollection($object)
    {
        if($object == null)
            return false;

        return in_array("Collection", explode("\\", get_class($object)));
    }

    function applySelect($model, $select)
    {
        $remove = [];
        foreach (array_keys($model->attributesToArray()) as $attr) {
            if (!in_array($attr, $select)) {
                $remove[] = $attr;
            }
        }
        $model->makeHidden($remove);
    }
}
