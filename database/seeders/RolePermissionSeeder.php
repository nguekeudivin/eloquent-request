<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
         // Optionnel : trouver un utilisateur pour les champs d'audit
        // $auditorUser = User::where('username', 'super_admin')->first();

        // Trouver des rôles et permissions existants
        $adminRole = Role::where('nom', 'Administrateur')->first();
        $superAdminRole = Role::where('nom', 'Super Administrateur')->first();

        $viewUsersPermission = Permission::where('code', 'view-users')->first();
        $manageRolesPermission = Permission::where('code', 'manage-roles')->first();
        $assignRolesPermission = Permission::where('code', 'assign-roles')->first();
        $assignPermissionsPermission = Permission::where('code', 'assign-permissions')->first();

        $permissionsToAssign = [];

        if ($adminRole && $viewUsersPermission) {
            $permissionsToAssign[$adminRole->id][] = $viewUsersPermission->id;
        }

        if ($superAdminRole && $viewUsersPermission && $manageRolesPermission && $assignRolesPermission && $assignPermissionsPermission) {
             $permissionsToAssign[$superAdminRole->id][] = $viewUsersPermission->id;
             $permissionsToAssign[$superAdminRole->id][] = $manageRolesPermission->id;
             $permissionsToAssign[$superAdminRole->id][] = $assignRolesPermission->id;
             $permissionsToAssign[$superAdminRole->id][] = $assignPermissionsPermission->id;
        }

        $pivotDataTemplate = [
            'date_attribution' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        foreach ($permissionsToAssign as $roleId => $permissionIds) {
            $role = Role::find($roleId);
            if ($role) {
                // Sync va ajouter/supprimer pour que seuls les IDs dans $permissionIds soient attachés
                // Le second argument de sync permet de définir des valeurs pivot pour TOUTES les relations
                $role->permissions()->syncWithPivotValues($permissionIds, $pivotDataTemplate, false); // False pour ne pas détacher les permissions non listées si elles existent déjà
                $this->command->info('Permissions synchronisées pour rôle "' . $role->nom . '".');
            }
        }

        $this->command->info('Attributions rôle-permission seedées.');
    }
}
