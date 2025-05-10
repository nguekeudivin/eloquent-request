<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\TypeStatut;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $actifStatus = TypeStatut::where('code_interne', 'USER_ACTIF')
                                   ->where('contexte', 'user')
                                   ->first();

        if (!$actifStatus) {
             $this->command->info('Le statut "USER_ACTIF" (contexte "user") n\'a pas été trouvé. Veuillez exécuter TypeStatutSeeder d\'abord.');
             return;
        }

        $userData = [
             'username' => 'admin_principal',
             'email' => 'principal.admin@example.com',
             'password' => Hash::make('password'),
             'statut_id' => $actifStatus->id,
             'email_verified_at' => Carbon::now(),
             'last_connexion' => Carbon::now(),
        ];

        $user = User::firstOrCreate(['email' => $userData['email']], $userData);

        Admin::firstOrCreate(
            ['id' => $user->id],
            [
                'id' => $user->id,
                'nom' => 'Principal',
                'prenom' => 'Admin',
                'service' => 'Direction',
            ]
        );
    }
}
