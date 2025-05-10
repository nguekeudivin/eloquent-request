<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Référence au modèle Admin
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::with('user')->whereHas('user', function ($query) { // Utilisation du modèle Admin
            $query->where('username', 'admin_principal');
        })->first();

        $role = Role::where('nom', 'Super Administrateur')->first();

         $auditorUser = User::where('username', 'super_admin')->first();

        if ($admin && $role) { // Utilisation de la variable admin
            $pivotData = [
                'date_attribution' => Carbon::now(),
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(),
            ];

             if ($auditorUser) {
                 $pivotData['created_by_user_id'] = $auditorUser->id;
                 $pivotData['updated_by_user_id'] = $auditorUser->id;
             }

            if (!$admin->roles()->where('role_id', $role->id)->exists()) { // Utilisation de la variable admin
                 $admin->roles()->attach($role->id, $pivotData); // Utilisation de la variable admin
                $this->command->info('Attribué rôle "' . $role->nom . '" à administrateur "' . $admin->user->username . '".'); // Utilisation de la variable admin
            } else {
                $this->command->info('Rôle "' . $role->nom . '" déjà attribué à administrateur "' . $admin->user->username . '".'); // Utilisation de la variable admin
            }

            // Exemple d'une autre attribution
            // $anotherAdmin = Admin::with('user')->whereHas('user', function ($query) { // Utilisation du modèle Admin
            //     $query->where('username', 'another_admin_username');
            // })->first();
            // ... (reste du code similaire)
        } else {
            if (!$admin) { // Utilisation de la variable admin
                 $this->command->info('Administrateur "admin_principal" non trouvé. Veuillez exécuter AdminSeeder d\'abord.'); // Nom du seeder changé
            }
             if (!$role) {
                 $this->command->info('Rôle "Super Administrateur" non trouvé. Veuillez exécuter RoleSeeder d\'abord.');
            }
        }
    }
}
