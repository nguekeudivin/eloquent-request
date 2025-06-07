<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;

class PermissionSeeder extends Seeder
{
    // Define custom permissions here.
    // Structure: ['name' => '...', 'resource' => '...', 'description' => '...']
    protected $customPermissions = [
        [
            'name' => 'User:verified',
            'model' => 'User',
        ],
    ];

    public function run(): void
    {
        // Important: Truncate table before seeding if you want a clean state
        DB::table('permissions')->delete();

        $modelPath = app_path('Models');
        $modelFiles = glob($modelPath . '/*.php');
        $generatedPermissions = [];

        // Iterate through all Eloquent models found in the Models directory
        foreach ($modelFiles as $modelFile) {
            $filename = basename($modelFile, '.php');
            $modelClass = "App\\Models\\" . $filename;

            // Process if the file contains a valid, non-abstract Eloquent model
            if (class_exists($modelClass) && is_subclass_of($modelClass, Model::class) && ! (new ReflectionClass($modelClass))->isAbstract()) {
                $reflection = new ReflectionClass($modelClass);
                $modelInstance = new $modelClass();

                // Resource name (e.g., 'user', 'role', 'rolepermission')
                $model = Str::studly($filename);

                $tableName = $modelInstance->getTable();
                $columns = Schema::getColumnListing($tableName);

                // Ensure $columns is an array before iterating to avoid undefined variable errors
                if (!is_array($columns)) {
                    $this->command->warn("Schema::getColumnListing returned non-array for table {$tableName}. Skipping attribute permissions for this model.");
                    $columns = []; // Set to an empty array to prevent errors in the following loops
                }

                // === READ/VIEW PERMISSIONS ===
                //  Model:list
                $generatedPermissions[] = [
                    'name' => "{$model}:list",
                    'model' => $model,
                ];

                // Model:list:filter_name
                if ($reflection->hasMethod('queryFilters') && $reflection->getMethod('queryFilters')->isStatic() && $reflection->getMethod('queryFilters')->isPublic()) {
                    try {
                        $filterMethods = $modelClass::queryFilters();
                        if (is_array($filterMethods)) {
                            foreach ($filterMethods as $filterName => $filterClosure) {
                                if (is_callable($filterClosure)) {
                                    $generatedPermissions[] = [
                                        'name' => "{$model}:list:{$filterName}",
                                        'model' => $model,
                                    ];
                                }
                            }
                        }
                    } catch (Exception $e) {
                        $this->command->warn("Impossible d'appeler queryFilters() sur le modèle {$modelClass} pour les filtres de liste: " . $e->getMessage());
                    }
                }

                // Model:view:*
                $generatedPermissions[] = [
                    'name' => "{$model}:view:*",
                    'model' => $model,
                ];

                // Pattern: resource:view:attribute_name (Access to specific attribute data on instance)
                foreach ($columns as $column) {
                    // Exclude standard audit columns from granular view permissions if desired
                    // if (in_array($column, ['created_at', 'updated_at', 'created_by_user_id', 'updated_by_user_id'])) {
                    //     continue;
                    // }

                    $generatedPermissions[] = [
                        'name' => "{$model}:view:{$column}",
                        'model' => $model,
                    ];
                }

                if (isset($modelInstance->rels)) {
                    foreach ($modelInstance->rels as $relationName) {
                        $generatedPermissions[] = [
                           'name' => "$model:view:{$relationName}",
                           'model' => $model, // Indicative resource
                        ];

                        $relationInstance = $reflection->getMethod($relationName)->invoke($modelInstance);
                        $relatedModel = $relationInstance->getRelated();
                        $relatedModelClass = get_class($relatedModel);
                        $reflectionRelated = new ReflectionClass($relatedModelClass);
                        // Check if the related model has queryFilters()
                        if ($reflectionRelated->hasMethod('queryFilters') && $reflectionRelated->getMethod('queryFilters')->isStatic() && $reflectionRelated->getMethod('queryFilters')->isPublic()) {

                            $filterMethodsRelated = $relatedModelClass::queryFilters();
                            if (is_array($filterMethodsRelated)) {
                                foreach ($filterMethodsRelated as $filterName => $filterClosure) {
                                    // Ensure it's a callable filter
                                    if (is_callable($filterClosure)) {
                                        $generatedPermissions[] = [
                                           // Pattern: resource:view:relation_name:filter_name
                                           'name' => "{$model}:view:{$relationName}:${filterName}",
                                           'model' => $model,
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }

                // === CUD PERMISSIONS ===
                $operations = ['create', 'update', 'delete']; // Standard CUD operations
                foreach ($operations as $op) {
                    // Model:operation
                    $generatedPermissions[] = [
                        'name' => $model . ':' . $op,
                        'model' => $model,
                    ];
                    if ($op === 'create' || $op === 'update') {
                        // Model:operation:*
                        $generatedPermissions[] = [
                            'name' => $model . ':' . $op . ':*',
                            'model' => $model,
                        ];
                        // Model:operation:attribute_name
                        foreach ($columns as $column) {
                            // Exclude columns that should never be set directly via API (ID, timestamps)
                            if (in_array($column, ['id', 'created_at', 'updated_at'])) {
                                continue;
                            }

                            // Check if the column exists in the table for robustness
                            if (!Schema::hasColumn($tableName, $column)) {
                                continue;
                            }

                            $generatedPermissions[] = [
                               'name' => $model . ':' . $op . ':' . $column,
                               'model' => $model,
                             ];
                        }
                    }
                }
            }
        }

        // Merge generated permissions with custom permissions
        $allPermissions = array_merge($generatedPermissions, $this->customPermissions);

        // Ensure uniqueness before inserting using ONLY the 'name' column as the key
        $uniquePermissions = [];
        $seen = [];
        foreach ($allPermissions as $permission) {
            // The unique key is the full permission string stored in the 'name' column
            $key = $permission['name'] ?? null;

            // Skip permissions with empty name or name starting with ':' (shouldn't happen with current logic but adds robustness)
            if (empty($key) || Str::startsWith($key, ':')) {
                $this->command->warn('Permission invalide trouvée et ignorée (nom vide ou invalide) : ' . json_encode($permission));
                continue;
            }

            if (!isset($seen[$key])) {
                $uniquePermissions[] = $permission;
                $seen[$key] = true;
            } else {
                // Optionally log a warning if a duplicate is found that was correctly formed
                // $this->command->warn("Permission dupliquée correctement formée trouvée et ignorée : name='{$permission['name']}'");
            }
        }


        // Insert the generated and custom permissions into the database
        DB::table('permissions')->insert(array_map(function ($permission) {
            $now = Carbon::now();
            // Add timestamps; audit fields created_by/updated_by are not in the permissions table itself
            return array_merge(
                $permission, // Use the permission data directly (already has name, resource, description)
                ['created_at' => $now, 'updated_at' => $now] // Add timestamps
            );
        }, $uniquePermissions)); // Insert unique permissions

        $this->command->info('Permissions generated and custom permissions saved to the database.');
    }
}
