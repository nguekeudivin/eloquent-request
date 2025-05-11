<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class GenerateModelPermissions extends Command
{
    protected $signature = 'generate:permissions {model} {--save : Save the generated permissions}';
    protected $description = 'Generate default permissions for a given model';

    public function handle()
    {
        $modelName = $this->argument('model');
        $modelClass = "App\\Models\\" . Str::studly($modelName);

        if (!class_exists($modelClass) || !is_subclass_of($modelClass, Model::class)) {
            $this->error("Model '{$modelName}' not found.");
            return;
        }

        $model = new $modelClass();
        $tableName = $model->getTable();
        $columns = Schema::getColumnListing($tableName);
        $permissions = [];

        $singularModelName = Str::lower($modelName);

        // Permissions de lecture (attributs)
        foreach ($columns as $column) {
            $permissions[] = "{$singularModelName}.{$column}";
        }
        $permissions[] = "{$singularModelName}.*";

        // Permissions de lecture (relations)
        $reflection = new ReflectionClass($modelClass);
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            if ($method->getName() !== '__construct' && !$method->isStatic() && $method->getNumberOfParameters() === 0) {
                $returnType = (string) $method->getReturnType();
                if (class_exists($returnType) && is_subclass_of($returnType, Relation::class)) {
                    $relationName = $method->getName();
                    $permissions[] = "{$singularModelName}.{$relationName}";
                }
            }
        }

        // Permissions de CRUD
        $permissions[] = "{$singularModelName}:create";
        $permissions[] = "{$singularModelName}:create:*";

        foreach ($columns as $column) {
            $permissions[] = "{$singularModelName}:create:{$column}";
        }
        $permissions[] = "{$singularModelName}:update";
        $permissions[] = "{$singularModelName}:update:*";
        foreach ($columns as $column) {
            $permissions[] = "{$singularModelName}:update:{$column}";
        }
        $permissions[] = "{$singularModelName}:delete";

        $this->info("Generated permissions for model '{$modelName}':");
        foreach ($permissions as $permission) {
            $this->line("- {$permission}");
        }

        if ($this->option('save')) {
            // Logique pour enregistrer les permissions dans votre système
            $this->info("Permissions saved (implementation pending).");
        }
    }
}
