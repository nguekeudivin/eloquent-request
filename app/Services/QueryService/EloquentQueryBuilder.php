<?php

namespace App\Services\QueryService;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class EloquentQueryBuilder
{
    /**
     * Construit une requête Eloquent à partir de la définition de la requête.
     */
    public function build(string $modelClass, object $query): Builder
    {
        $model = new $modelClass();
        $eloquentQuery = $model->newQuery();

        // Appliquer les clauses de base (select, where, order)
        $eloquentQuery = $this->evaluateQuery($eloquentQuery, $query);

        // Appliquer les relations (avec leurs propres sous-requêtes)
        if (property_exists($query, "rels")) {
            $this->evaluateRels($eloquentQuery, $query->rels);
        }

        return $eloquentQuery;
    }

    /**
     * Évalue et applique les clauses de base de la requête (select, where, order).
     */
    protected function evaluateQuery(Builder $eloquentQuery, object $query): Builder
    {

        // Evaluate select
        if (property_exists($query, "select")) {
            $eloquentQuery->select(...$query->select);
        }

        // Evaluates clauses
        if (property_exists($query, "clauses")) {
            foreach ($query->clauses as $clause) {
                $this->evaluateClause($eloquentQuery, $clause->name, $clause->value);
            }
        }

        //Evaluate order.
        if (property_exists($query, "order")) {
            foreach ($query->order as $item) {
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
        foreach ((array) $rels as $key => $value) {
            $with[$key] = function ($query) use ($value) {
                if (property_exists($value, "select")) {
                    $query->select(...$value->select);
                }
                if (property_exists($value, "clauses")) {
                    foreach ($value->clauses as $clause) {
                        $this->evaluateClause($query, $clause->name, $clause->value);
                    }
                }
                if (property_exists($value, "order")) {
                    foreach ($value->order as $item) {
                        $query->orderBy(...$item);
                    }
                }
                if (property_exists($value, "rels")) {
                    $this->evaluateRels($query, $value->rels);
                }
            };
        }
        if (!empty($with)) {
            $eloquentQuery->with($with);
        }
    }
}
