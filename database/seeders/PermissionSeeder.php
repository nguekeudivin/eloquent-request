<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['code' => 'view-users', 'description' => 'Permet de visualiser la liste des utilisateurs'],
            ['code' => 'create-user', 'description' => 'Permet de créer un nouvel utilisateur'],
            ['code' => 'edit-user', 'description' => 'Permet de modifier un utilisateur existant'],
            ['code' => 'delete-user', 'description' => 'Permet de supprimer un utilisateur'],

            ['code' => 'view-roles', 'description' => 'Permet de visualiser la liste des rôles'],
            ['code' => 'manage-roles', 'description' => 'Permet de créer, modifier, supprimer des rôles'],

            ['code' => 'assign-roles', 'description' => 'Permet d\'assigner des rôles aux utilisateurs'],
            ['code' => 'assign-permissions', 'description' => 'Permet d\'assigner des permissions aux rôles ou utilisateurs'],
        ];

        foreach ($permissions as $permissionData) {
            $permission = Permission::firstOrCreate(
                ['code' => $permissionData['code']], // Condition de recherche changée ici
                $permissionData
            );
        }

        $this->command->info('Permissions seedées.');
    }
}
