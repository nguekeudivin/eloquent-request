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
    public function run(): void
    {

        $roles = [
            [
                'name' => 'Super Administrateur',
                'code' => 'super_admin',
                'description' => 'Accès complet au système',
                'permissions' => Permission::pluck('name')
            ],
            [
                'name' => 'Mutualiste',
                'code' => 'mutualiste',
                'description' =>  "Acces aux donnees et operations d'un mutualiste. Cet access mutualiste autorise le mutualiste a voir ses informations et effectuer les operations systemes qui le concerne",
                'permissions' => [
                    // Mutualiste
                    'mutualiste:list:self',
                    'mutualiste:view',
                    'mutualiste:view:*',
                    'mutualiste:update',
                    'mutualiste:update:*',
                    // Notification
                    'notification:list:mine',
                    'notification:view',
                    'notification:view:*',
                    'notification:update',
                    'notification:update:*'
                ]
            ],
            [
                'name' => 'Gestion Mutualiste',
                'code'=> 'gestion_mutualiste',
                'description' => "Gestion des mutualistes. Cet access autorise un administrateur enregistrer, visualiser, modifier et supprimer un mutualiste ainsi que ses ayants droits.",
                'permissions' => [
                    'mutualiste:list',
                    'mutualiste:view',
                    "mutualiste:view:*",
                    'mutualiste:create',
                    'mutualiste:create:*',
                    'mutualiste:update',
                    'mutualiste:update:*',
                    'mutualiste:delete'
                ]
            ]
        ];

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(
                ['code' => $roleData['code']],
                [
                    'name' => $roleData['name'],
                    'code' => $roleData['code'],
                    'description' => $roleData['description']
                ]
            );

            foreach($roleData['permissions'] as $permisionName){
                RolePermission::create([
                    'role_id' => $role->id,
                    'permission_id' => Permission::where('name',$permisionName)->first()->id
                ]);
            }
        }

        $this->command->info('Rôles seedés.');
    }
}
