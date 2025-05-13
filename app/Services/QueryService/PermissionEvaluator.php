<?php

namespace App\Services\QueryService;

use Illuminate\Support\Str;

class PermissionEvaluator
{

    protected $models = [];

    public function setModels($models){
        $this->models = $models;
    }

    public function hasModelAccess(string $modelSingulier, object $queryDefinition, array $userPermissions): bool
    {
        return in_array("{$modelSingulier}.*", $userPermissions) || !empty((array) $queryDefinition);
    }

    public function canListModel(string $modelSingulier, array $userPermissions): bool
    {
        return in_array("{$modelSingulier}:list", $userPermissions);
    }

    public function getApplicableListFilters(string $modelSingulier, array $userPermissions, string $modelClass): array
    {
        $appliedFilters = [];
        // Appeler la méthode statique pour obtenir le tableau des filtres
        $modelFilters = $modelClass::queryFilters() ?? [];

        foreach ($modelFilters as $filterName => $filterFunction) {
            $filterPermission = "{$modelSingulier}:list:{$filterName}";
            if (in_array($filterPermission, $userPermissions)) {
                $appliedFilters[] = $filterName; // Stock the filter name
            }
        }
        return $appliedFilters;
    }

    public function getApplicableRelationFilters(string $permissionRoot, array $userPermissions, string $relatedModelClass){
        $appliedFilters = [];
        $modelFilters = $relatedModelClass::queryFilters() ?? [];

        foreach ($modelFilters as $filterName => $filterFunction) {
            $filterPermission = "{$permissionRoot}:{$filterName}";
            if (in_array($filterPermission, $userPermissions)) {
                $appliedFilters[] = $filterName; // Stock the filter name
            }
        }
        return $appliedFilters;
    }

    public function filterModelQueryBasNiveau(string $modelSingulier, object $queryDefinition, array $userPermissions): object
    {
        $filteredDefinition = [];

        // Filtrer la clause 'select'
        if (isset($queryDefinition->select)) {
            $filteredSelect = [];
            foreach ($queryDefinition->select as $attribute) {
                if (in_array("{$modelSingulier}:view:{$attribute}", $userPermissions) || in_array("{$modelSingulier}:view:*", $userPermissions)) {
                    $filteredSelect[] = $attribute;
                }
            }
            if (!empty($filteredSelect)) {
                $filteredDefinition['select'] = $filteredSelect;
            }
        }

        // Filtrer les attributs computed
        if (isset($queryDefinition->computed)) {
            $filteredComputed = [];
            foreach ((array) $queryDefinition->computed as $attribute => $args) {
                if (in_array("{$modelSingulier}:view:{$attribute}", $userPermissions) || in_array("{$modelSingulier}:view:*", $userPermissions)) {
                    $filteredComputed[$attribute] = $args;
                }
            }
            if (!empty($filteredComputed)) {
                $filteredDefinition['computed'] = $filteredComputed;
            }
        }

        // Filtrer les relations
        if (isset($queryDefinition->rels)) {
            $filteredRels = [];
            foreach ( $queryDefinition->rels as $relationName => $relationQuery) {

                // User as total access token user relation data.
                if (in_array("{$modelSingulier}:view:{$relationName}", $userPermissions) || in_array("{$modelSingulier}:view:*", $userPermissions)) {
                    $relatedModelSingulier = Str::singular($relationName);

                    $filtered = $this->filterModelQueryBasNiveau($relatedModelSingulier, (object)$relationQuery, $userPermissions);
                    if(isset($filtered->select)){
                        $filteredRels[$relationName] = $filtered;
                    }
                }
                else{
                    // If not check if partial access is allow under some conditions.
                    $relatedModelSingulier = Str::singular($relationName);
                    $relatedModelClass = $this->models[$relatedModelSingulier];

                    $appliedFilters = $this->getApplicableRelationFilters("{$modelSingulier}:view:{$relationName}", $userPermissions, $relatedModelClass);

                    if(!empty($appliedFilters)){

                        $filtered = $this->filterModelQueryBasNiveau($relatedModelSingulier, (object)$relationQuery, $userPermissions);
                        if(isset($filtered->select)){
                            $filteredRels[$relationName] = $filtered;
                            $filteredRels[$relationName]->appliedRelationFilters = $appliedFilters;
                        }
                    }
                }
            }

            if (!empty($filteredRels)) {
                $filteredDefinition['rels'] = $filteredRels;
            }
        }

        // Conserver les autres clauses
        foreach (['clauses', 'order', 'paginate', 'limit'] as $key) {
            if (isset($queryDefinition->$key)) {
                $filteredDefinition[$key] = $queryDefinition->$key;
            }
        }

        return (object) $filteredDefinition;
    }
}
