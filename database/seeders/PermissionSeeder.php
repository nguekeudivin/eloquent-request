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
use Illuminate\Support\Carbon; // Importer Carbon

class PermissionSeeder extends Seeder
{
    protected $customPermissions = [
        [
            'code' => 'report.generate_sales',
            'resource' => 'report',
            'description' => 'Autorise la génération des rapports de ventes.',
        ],
        [
            'code' => 'notification.send_email',
            'resource' => 'notification',
            'description' => 'Autorise l\'envoi d\'e-mails de notification.',
        ],
        [
            'code' => 'user.activate',
            'resource' => 'user',
            'description' => 'Autorise l\'activation d\'un compte utilisateur.',
        ],
    ];

    public function run()
    {
        // Supprimer les permissions existantes pour éviter les doublons lors des ré-exécutions si la table n'est pas vidée
         DB::table('permissions')->truncate();

        $modelPath = app_path('Models');
        $modelFiles = glob($modelPath . '/*.php');
        $generatedPermissions = [];
         $auditorUser = null; // Définir l'utilisateur d'audit si nécessaire, par exemple : User::first();

        foreach ($modelFiles as $modelFile) {
            $filename = basename($modelFile, '.php');
            $modelName = "App\\Models\\" . $filename;

            if (class_exists($modelName) && is_subclass_of($modelName, Model::class) && ! (new ReflectionClass($modelName))->isAbstract()) {
                $model = new $modelName();
                $tableName = $model->getTable();
                $columns = Schema::getColumnListing($tableName);
                $singularModelName = Str::lower($filename); // Nom du modèle en snake_case singulier
                $pluralModelName = Str::plural($singularModelName); // Nom du modèle en snake_case pluriel

                // Permission de Listing (nouvelle convention)
                 $generatedPermissions[] = [
                     'code' => $pluralModelName, // Nom du modèle au pluriel
                     'resource' => $singularModelName, // Ressource associée (singulier)
                     'description' => "Autorise la visualisation de la liste des {$pluralModelName}.",
                 ];

                // Permissions de lecture (attributs)
                foreach ($columns as $column) {
                    $generatedPermissions[] = [
                        'code' => "{$singularModelName}.{$column}",
                        'resource' => $singularModelName,
                        'description' => "Autorise la lecture de l'attribut '{$column}' du modèle '{$filename}'.",
                    ];
                }
                 // Permission de lecture de tous les attributs/relations
                 $generatedPermissions[] = [
                    'code' => "{$singularModelName}.*",
                    'resource' => $singularModelName,
                    'description' => "Autorise la lecture de tous les attributs et relations du modèle '{$filename}'.",
                 ];


                // Permissions de lecture (relations)
                $reflection = new ReflectionClass($modelName);
                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                     // Filtrer les méthodes qui sont des relations Eloquent
                     if ($method->getNumberOfParameters() === 0) { // Les relations n'ont généralement pas de paramètres requis
                        $returnType = $method->getReturnType();
                        if ($returnType && class_exists($returnType->getName()) && is_subclass_of($returnType->getName(), Relation::class)) {
                             $relationName = $method->getName();
                             $generatedPermissions[] = [
                                'code' => "{$singularModelName}.{$relationName}",
                                'resource' => $singularModelName,
                                'description' => "Autorise l'accès à la relation '{$relationName}' du modèle '{$filename}'.",
                             ];
                         }
                    }
                }

                // Permissions de CRUD (Opérations au niveau de l'instance)
                $operations = ['create', 'update', 'delete'];
                foreach($operations as $op) {
                    $generatedPermissions[] = [
                        'code' => "{$singularModelName}:{$op}",
                        'resource' => $singularModelName,
                        'description' => "Autorise l'opération '{$op}' sur une instance du modèle '{$filename}'.",
                    ];
                     // Opération sur tous les attributs pour C/U
                     if ($op === 'create' || $op === 'update') {
                         $generatedPermissions[] = [
                             'code' => "{$singularModelName}:{$op}:*",
                             'resource' => $singularModelName,
                             'description' => "Autorise l'opération '{$op}' sur une instance du modèle '{$filename}' et la définition de tous ses attributs.",
                         ];
                         foreach ($columns as $column) {
                              $generatedPermissions[] = [
                                 'code' => "{$singularModelName}:{$op}:{$column}",
                                 'resource' => $singularModelName,
                                 'description' => "Autorise l'opération '{$op}' sur l'attribut '{$column}' lors de l'opération sur le modèle '{$filename}'.",
                             ];
                         }
                     }
                }
            }
        }

        // Merge generated permissions with custom permissions
        $allPermissions = array_merge($generatedPermissions, $this->customPermissions);

        // Insert the generated and custom permissions into the database
        DB::table('permissions')->insert(array_map(function ($permission) use ($auditorUser) {
             $now = Carbon::now();
             $auditUserId = $auditorUser ? $auditorUser->id : null; // Utiliser l'ID de l'utilisateur d'audit si défini
            return array_merge(
                 ['id' => Str::uuid()],
                 $permission,
                 ['created_at' => $now, 'updated_at' => $now, 'created_by_user_id' => $auditUserId, 'updated_by_user_id' => $auditUserId]
            );
        }, $allPermissions));

        $this->command->info('Permissions generated and custom permissions saved to the database.');
    }
}
