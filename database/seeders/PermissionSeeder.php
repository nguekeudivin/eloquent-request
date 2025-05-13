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
            'name' => 'user:activate',
            'resource' => 'user',
            'description' => 'Autorise l\'activation d\'un compte utilisateur.',
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
            $modelName = "App\\Models\\" . $filename;

            // Process if the file contains a valid, non-abstract Eloquent model
            if (class_exists($modelName) && is_subclass_of($modelName, Model::class) && ! (new ReflectionClass($modelName))->isAbstract()) {
                $reflection = new ReflectionClass($modelName);
                $model = new $modelName();

                // Resource name (e.g., 'user', 'role', 'rolepermission')
                $singularModelName = Str::snake($filename);


                $tableName = $model->getTable();
                $columns = Schema::getColumnListing($tableName);

                 // Ensure $columns is an array before iterating to avoid undefined variable errors
                 if (!is_array($columns)) {
                     $this->command->warn("Schema::getColumnListing returned non-array for table {$tableName}. Skipping attribute permissions for this model.");
                     $columns = []; // Set to an empty array to prevent errors in the following loops
                 }

                // === READ/VIEW PERMISSIONS ===

                // Pattern: resource:list (Access to list endpoint)
                $generatedPermissions[] = [
                    'name' => $singularModelName . ':' . 'list', // Full permission string in 'name'
                    'resource' => $singularModelName, // Indicative resource
                    'description' => "Autorise la visualisation de la liste des " . Str::plural($filename) . ".",
                ];

                // Pattern: resource:list:filter_name (Access to list endpoint with filter)
                // Generated based on queryFilters() method in the current model
                 if ($reflection->hasMethod('queryFilters') && $reflection->getMethod('queryFilters')->isStatic() && $reflection->getMethod('queryFilters')->isPublic()) {
                     try {
                         $filterMethods = $modelName::queryFilters();
                         if (is_array($filterMethods)) {
                             foreach ($filterMethods as $filterName => $filterClosure) {
                                  if (is_callable($filterClosure)) {
                                     $generatedPermissions[] = [
                                        'name' => $singularModelName . ':' . 'list:' . $filterName, // Full permission string in 'name'
                                        'resource' => $singularModelName, // Indicative resource
                                        'description' => "Autorise la visualisation de la liste du modèle '{$filename}' filtrée par '{$filterName}'.",
                                     ];
                                 }
                             }
                         }
                     } catch (Exception $e) {
                         // Log warning if queryFilters() call fails
                         $this->command->warn("Impossible d'appeler queryFilters() sur le modèle {$modelName} pour les filtres de liste: " . $e->getMessage());
                     }
                 }

                // Pattern: resource:view (Access to single instance endpoint 'show')
                $generatedPermissions[] = [
                    'name' => $singularModelName . ':' . 'view', // Full permission string in 'name'
                    'resource' => $singularModelName, // Indicative resource
                    'description' => "Autorise la visualisation d'une instance unique du modèle '{$filename}'.",
                ];

                 // Pattern: resource:view:* (Access to all attributes/relations on instance)
                 $generatedPermissions[] = [
                     'name' => $singularModelName . ':' . 'view:*', // Full permission string in 'name'
                     'resource' => $singularModelName, // Indicative resource
                     'description' => "Autorise la visualisation de tous les attributs et relations d'une instance du modèle '{$filename}'.",
                 ];


                // Pattern: resource:view:attribute_name (Access to specific attribute data on instance)
                foreach ($columns as $column) {
                   // Exclude standard audit columns from granular view permissions if desired
                    if (in_array($column, ['created_at', 'updated_at', 'created_by_user_id', 'updated_by_user_id'])) {
                        continue;
                    }
                   $generatedPermissions[] = [
                       'name' => $singularModelName . ':' . 'view:' . $column, // Full permission string in 'name'
                       'resource' => $singularModelName, // Indicative resource
                       'description' => "Autorise la visualisation de l'attribut '{$column}' d'une instance du modèle '{$filename}'.",
                   ];
                }

                // Pattern: resource:view:relation_name (Access to specific relation data on instance)
                // Pattern: resource:view:relation_name:filter_name (Access to specific relation data on instance, filtered)
                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                    // Check if the method is public, non-static, with no required parameters (common for relations)
                     if ($method->getName() !== '__construct' && !$method->isStatic() && $method->getNumberOfParameters() === 0) {
                        try {
                             $returnType = $method->getReturnType();
                             // Check if the return type is a valid Eloquent Relation class
                             if ($returnType && class_exists($returnType->getName()) && is_subclass_of($returnType->getName(), Relation::class)) {
                                 $relationName = Str::snake($method->getName());
                                 // Generate permission for accessing the relation itself
                                 $generatedPermissions[] = [
                                    'name' => $singularModelName . ':' . 'view:' . $relationName, // Full permission string in 'name'
                                    'resource' => $singularModelName, // Indicative resource
                                    'description' => "Autorise la visualisation de la relation '{$relationName}' d'une instance du modèle '{$filename}'.",
                                 ];

                                 // Generate permissions for filtered relations based on queryFilters() in the RELATED model
                                  try { // Use try-catch as relation instantiation can fail
                                     $relationInstance = $method->invoke($model); // Instantiate the relation
                                     $relatedModel = $relationInstance->getRelated(); // Get the related model instance
                                     $relatedModelClass = get_class($relatedModel);
                                     $reflectionRelated = new ReflectionClass($relatedModelClass);

                                      // Check if the related model has queryFilters()
                                      if ($reflectionRelated->hasMethod('queryFilters') && $reflectionRelated->getMethod('queryFilters')->isStatic() && $reflectionRelated->getMethod('queryFilters')->isPublic()) {
                                         try {
                                              $filterMethodsRelated = $relatedModelClass::queryFilters();
                                              if (is_array($filterMethodsRelated)) {
                                                  foreach ($filterMethodsRelated as $filterName => $filterClosure) {
                                                       // Ensure it's a callable filter
                                                       if (is_callable($filterClosure)) {
                                                           $generatedPermissions[] = [
                                                              // Pattern: resource:view:relation_name:filter_name
                                                              'name' => $singularModelName . ':' . 'view:' . $relationName . ':' . $filterName, // Full permission string in 'name'
                                                              'resource' => $singularModelName, // Indicative resource
                                                              'description' => "Autorise la visualisation de la relation '{$relationName}' du modèle '{$filename}' filtrée par '{$filterName}' (filtre sur modèle lié '{$reflectionRelated->getShortName()}').",
                                                           ];
                                                      }
                                                  }
                                              }
                                         } catch (Exception $e) {
                                             // Log warning if queryFilters() on related model fails
                                             $this->command->warn("Impossible d'appeler queryFilters() sur le modèle lié {$relatedModelClass} pour la relation filtrée {$modelName}->{$relationName}(): " . $e->getMessage());
                                         }
                                     }
                                 } catch (Exception $e) {
                                   // Log warning if relation instantiation/inspection fails
                                   $this->command->warn("Impossible d'instancier ou d'inspecter la relation {$modelName}->{$method->getName()}() pour les filtres: " . $e->getMessage());
                               }
                             }
                        } catch (Exception $e) {
                           // Log warning if relation inspection fails
                           $this->command->warn("Erreur d'inspection de relation {$modelName}->{$method->getName()}() pour la visualisation: " . $e->getMessage());
                       }
                    }
                }

                // === CUD PERMISSIONS ===

                $operations = ['create', 'update', 'delete']; // Standard CUD operations
                foreach($operations as $op) {
                    // Pattern: resource:operation (Base CRUD operation on instance)
                    $generatedPermissions[] = [
                        'name' => $singularModelName . ':' . $op, // Full permission string in 'name'
                        'resource' => $singularModelName, // Indicative resource
                        'description' => "Autorise l'opération '{$op}' sur une instance du modèle '{$filename}'.",
                    ];
                     if ($op === 'create' || $op === 'update') {
                         // Pattern: resource:operation:* (Wildcard attribute permission for C/U)
                         $generatedPermissions[] = [
                             'name' => $singularModelName . ':' . $op . ':*', // Full permission string in 'name'
                             'resource' => $singularModelName, // Indicative resource
                             'description' => "Autorise l'opération '{$op}' sur une instance du modèle '{$filename}' et la définition de tous ses attributs.",
                         ];
                         // Pattern: resource:operation:attribute_name (Granular attribute permission for C/U)
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
                                 'name' => $singularModelName . ':' . $op . ':' . $column, // Full permission string in 'name'
                                 'resource' => $singularModelName, // Indicative resource
                                 'description' => "Autorise l'opération '{$op}' sur l'attribut '{$column}' lors de l'opération sur le modèle '{$filename}'.",
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
