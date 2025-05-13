<?php

namespace App\Services\QueryService;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Models\User;

class EloquentQueryBuilder
{
    protected $user = null;

    public function setUser($user){
        $this->user = $user;
    }

    /**
     * Construit une requête Eloquent à partir de la définition de la requête.
     */
    public function build(string $modelClass, object $definition): Builder
    {
        $model = new $modelClass();
        $eloquentQuery = $model->newQuery();

        // Appliquer les clauses de base (select, where, order)
        $eloquentQuery = $this->evaluateQuery($eloquentQuery, $definition);

        // Appliquer les relations (avec leurs propres sous-requêtes)
        if (property_exists($definition, "rels")) {
            $this->evaluateRels((object) $eloquentQuery, (object)$definition->rels);
        }

        return $eloquentQuery;
    }

    /**
     * Évalue et applique les clauses de base de la requête (select, where, order).
     */
    protected function evaluateQuery(Builder $eloquentQuery, object $definition): Builder
    {

        // Evaluate select
        if (property_exists($definition, "select")) {
            $eloquentQuery->select(...$definition->select);
        }

        // Evaluates clauses
        if (property_exists($definition, "clauses")) {
            foreach ($definition->clauses as $clause) {
                $this->evaluateClause($eloquentQuery, $clause->name, $clause->value);
            }
        }

        //Evaluate order.
        if (property_exists($definition, "order")) {
            foreach ($definition->order as $item) {
                $eloquentQuery->orderBy(...$item);
            }
        }

        return $eloquentQuery;
    }

    /**
     * Recursively evaluates query clauses, applying them to the query builder.
     */
    protected function evaluateClause(Builder $eloquentQuery, string $clauseName, $value): void
    {
        if (is_array($value) && is_object(reset($value))) {
            $eloquentQuery->{$clauseName}(function ($q) use ($value) {
                foreach ($value as $subClause) {
                    $this->evaluateClause($q, $subClause->name, $subClause->value);
                }
            });
        } else {
            $eloquentQuery->{$clauseName}(...$value);
        }
    }

    /**
     * Évalue et charge les relations eager loading avec leurs propres contraintes.
     */
    protected function evaluateRels(Builder $eloquentQuery, object $rels): void
    {
        $with = [];

        $user = $this->user;

        foreach ((array) $rels as $relationName => $definition) {

            $with[$relationName] = function ($relation) use ($relationName,$definition, $user) {

                $query = $relation->getQuery();

                if (property_exists($definition, "select")) {
                    $select = array_merge($definition->select, [$relation->getForeignKeyName()]);
                    $query->select(...$select);
                }

                if (property_exists($definition, "clauses")) {
                    foreach ($definition->clauses as $clause) {
                        $this->evaluateClause($query, $clause->name, $clause->value);
                    }
                }

                if (property_exists($definition, "order")) {
                    foreach ($definition->order as $item) {
                        $query->orderBy(...$item);
                    }
                }

                if (property_exists($definition, "rels")) {
                    $this->evaluateRels($query, $definition->rels);
                }

                //Appliquer les filtres de requete si presents
                if(isset($definition->appliedRelationFilters) && is_array($definition->appliedRelationFilters)){

                    $modelClass = $query->getModel()::class;
                    $filters = $modelClass::queryFilters() ?? [];

                    $query->where( function(Builder $someQuery) use ($definition, $filters, $user) {
                        $first = true;
                        foreach($definition->appliedRelationFilters as $filterName){

                            if(isset($filters[$filterName]) && is_callable($filters[$filterName])){
                                if(!$first){
                                    $someQuery->orWhere(function (Builder $q) use ($filters, $filterName, $user) {
                                        $filters[$filterName]($q, $user);
                                    });
                                }else{
                                    $filters[$filterName]($someQuery, $user);
                                    $first = false;
                                }
                            }
                        }

                    });

                }

            };

        }

        if (!empty($with)) {
            $eloquentQuery->with($with);
        }
    }
}
