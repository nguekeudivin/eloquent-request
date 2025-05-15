<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\StatusType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\UserRole;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $actifStatus = StatusType::where('code_interne', 'USER_ACTIF')
                                   ->where('contexte', 'user')
                                   ->first();

        if (!$actifStatus) {
             $this->command->info('Le statut "USER_ACTIF" (contexte "user") n\'a pas été trouvé. Veuillez exécuter StatusTypeSeeder d\'abord.');
             return;
        }

        $admins = [
            [
                'role' => 'super_admin',
                'user' =>  [
                    'username' => 'super_admin',
                    'email' => 'superadmin@example.com',
                    'password' => Hash::make('password'),
                    'statut_id' => $actifStatus->id,
                    'email_verified_at' => Carbon::now(),
                    'last_connexion' => Carbon::now(),
                ],
                'admin' => [
                    'nom' => 'Super',
                    'prenom' => 'Admin',
                    'service' => 'Direction'
                ]
            ],
            [

                'role' => 'gestion_mutualiste',
                'user' =>  [
                    'username' => 'gestionnaire',
                    'email' => 'gestionnaire@example.com',
                    'password' => Hash::make('password'),
                    'statut_id' => $actifStatus->id,
                    'email_verified_at' => Carbon::now(),
                    'last_connexion' => Carbon::now(),
                ],
                'admin' => [
                    'nom' => 'Gestionnaire',
                    'prenom' => 'Mutualiste',
                    'service' => 'Direction',
                ]
            ],
            [
                'role' => 'gestion_reclamation',
                'user' =>  [
                    'username' => 'reclamation_service',
                    'email' => 'reclammation_service@example.com',
                    'password' => Hash::make('password'),
                    'statut_id' => $actifStatus->id,
                    'email_verified_at' => Carbon::now(),
                    'last_connexion' => Carbon::now(),
                ],
                'admin' => [
                    'nom' => 'Admin',
                    'prenom' => '3',
                    'service' => 'Direction',
                ]
            ]
        ];


        foreach($admins as $item){

            $user = User::firstOrCreate(['email' => $item['user']['email']], $item['user']);

            // Donner le role gestion mutualiste
            UserRole::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => Role::where('code',$item['role'])->first()->id
            ]);

            Admin::firstOrCreate(
                ['id' => $user->id],
                array_merge(
                    ['id' => $user->id], $item['admin'])
            );
        }
    }
}
