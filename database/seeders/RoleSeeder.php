<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

        $roles = [
            ['nom' => 'Super Administrateur', 'description' => 'Accès complet au système'],
            ['nom' => 'Administrateur', 'description' => 'Accès aux fonctions de gestion'],
            ['nom' => 'Responsable enregistrement', 'description' => "Charger d'enregistrer de nouveau mutualiste"],
        ];

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(
                ['nom' => $roleData['nom']],
                $roleData
            );
        }

        $this->command->info('Rôles seedés.');
    }
}
