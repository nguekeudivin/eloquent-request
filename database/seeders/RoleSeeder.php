<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\RolePermission;

class RoleSeeder extends Seeder
{
    public static function run(): void
    {

        $roles = self::roles();

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(
                ['code' => $roleData['code']],
                [
                    'name' => $roleData['name'],
                    'code' => $roleData['code'],
                    'description' => $roleData['description']
                ]
            );

            foreach ($roleData['permissions'] as $permisionName) {
                RolePermission::firstOrCreate([
                    'role_id' => $role->id,
                    'permission_id' => Permission::where('name', $permisionName)->first()->id
                ]);
            }
        }

    }



    public static function roles()
    {

        function total(string $modelName)
        {
            return [
                "{$modelName}:list",
                "{$modelName}:view:*",
                "{$modelName}:create",
                "{$modelName}:create:*",
                "{$modelName}:update",
                "{$modelName}:update:*",
                "{$modelName}:delete",
            ];
        }

        function total_instance(string $modelName)
        {
            return [
                "{$modelName}:view:*",
                "{$modelName}:create",
                "{$modelName}:create:*",
                "{$modelName}:update",
                "{$modelName}:update:*",
                "{$modelName}:delete",
            ];
        }
        function read_only(string $modelName)
        {
            return [
                "{$modelName}:list",
                "{$modelName}:view:*",
            ];
        }

        return [
            [
                'name' => 'Super Administrateur',
                'code' => 'super_admin',
                'description' => 'Détient l’accès complet à toutes les fonctionnalités du système. Gère les utilisateurs, rôles, permissions, paramètres globaux et l’activité du système. Peut effectuer des opérations critiques comme les sauvegardes, la résolution d’incidents techniques et la supervision générale. Ce rôle est réservé à un nombre restreint de personnes de confiance en raison de ses privilèges étendus.',
                'permissions' => Permission::pluck('name')
            ],
        ];
    }
}
