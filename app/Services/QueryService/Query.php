<?php

namespace App\Services\QueryService;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Query
{
    protected $request;
    protected $permissionEvaluator;
    protected $eloquentQueryBuilder;
    protected $queryRunner;
    protected $models = [
        "user" => \App\Models\User::class,
    ];

    public function __construct(
        PermissionEvaluator $permissionEvaluator,
        EloquentQueryBuilder $eloquentQueryBuilder,
        QueryRunner $queryRunner,
        Request $request
    ) {
        $this->permissionEvaluator = $permissionEvaluator;
        $this->eloquentQueryBuilder = $eloquentQueryBuilder;
        $this->queryRunner = $queryRunner;
        $this->request = $request;
    }

    public function setModels($models){
        $this->models = $models;
    }

    public function run($user)
    {
        // check user
        if($user == null){
            return [];
        }

        // Set the use permissions
        $userPermissions = $user->getPermissions();

        // Parse the query
        $requestQuery = (array) json_decode($this->request->input("query"), true);
        $finalResult = [];

        // Define need informations
        $this->permissionEvaluator->setModels($this->models);
        $this->eloquentQueryBuilder->setUser($user);
        $this->queryRunner->setUser($user);

        if (!is_array($requestQuery)) {
            return []; // Ou lancer une exception
        }

        foreach ($requestQuery as $modelAlias => $queryDefinition) {
            $modelSingulier = Str::singular($modelAlias);

            $modelClass = $this->models[$modelSingulier] ?? null;

            if (!$modelClass) {
                continue; // Ou lancer une exception
            }

            if ($this->permissionEvaluator->hasModelAccess($modelSingulier, (object) $queryDefinition, $userPermissions)) {

                $filteredDefinition = $this->permissionEvaluator->filterModelQueryBasNiveau($modelSingulier, (object) $queryDefinition, $userPermissions);

                if (!$this->permissionEvaluator->canListModel($modelSingulier, $userPermissions)) {

                    $appliedFilters = $this->permissionEvaluator->getApplicableListFilters($modelSingulier, $userPermissions, $modelClass);

                    if (!empty($appliedFilters)) {
                        $filteredDefinition->appliedListFilters = $appliedFilters;
                    } else {
                        continue; // L'utilisateur n'a pas la permission de lister ni de filtrer
                    }
                }

                // Il n'ya pas de select donc aucune information a recupere.
                // Generelement ce scenario se produit quand l'utilisateur n'a pas les permission sur les attributs.
                if(!isset($filteredDefinition->select)){
                    continue;
                }

                $eloquentQuery = $this->eloquentQueryBuilder->build($modelClass, (object) $filteredDefinition);

                $finalResult[$modelAlias] = $this->queryRunner->run($eloquentQuery, (object) $filteredDefinition);
            }
        }

        return $finalResult;
    }
}
