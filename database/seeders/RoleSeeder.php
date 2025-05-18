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
    static

    public function run(): void
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

            foreach($roleData['permissions'] as $permisionName){
                RolePermission::firstOrCreate([
                    'role_id' => $role->id,
                    'permission_id' => Permission::where('name',$permisionName)->first()->id
                ]);
            }
        }

    }



    static function roles() {

        function total(string $modelName)
        {
            return [
                "{$modelName}:list",
                "{$modelName}:view",
                "{$modelName}:view:*",
                "{$modelName}:create",
                "{$modelName}:create:*",
                "{$modelName}:update",
                "{$modelName}:update:*",
                "{$modelName}:delete",
            ];
        }

        function total_instance(string $modelName){
            return [
                "{$modelName}:view",
                "{$modelName}:view:*",
                "{$modelName}:create",
                "{$modelName}:create:*",
                "{$modelName}:update",
                "{$modelName}:update:*",
                "{$modelName}:delete",
            ];
        }
        function read_only(string $modelName){
            return [
                "{$modelName}:list",
                "{$modelName}:view",
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
            [
                'name' => 'Mutualiste',
                'code' => 'mutualiste',
                'description' => 'Représente un membre adhérent de la mutuelle. Accède à son espace personnel pour consulter ses informations, cotisations, prises en charge, allocations et réclamations. Peut initier des demandes et suivre leur traitement. Son accès est strictement limité à ses propres données.',
                'permissions' => Permission::pluck('name')
            ],
            [
                'name' => 'Gestion Mutualiste',
                'code' => 'gestion_mutualiste',
                'description' => 'Chargé de la gestion des membres de la mutuelle. Peut enregistrer des mutualistes, ayants droit, et gérer les adhésions (création, suspension, résiliation). Suit les cotisations, groupes et fonctions occupées. A un accès complet aux données des mutualistes pour assurer le suivi administratif.',
                'permissions' => array_merge(
                    total('mutualiste'),
                    total('ayant_droit'),
                    total('adhesion'),
                    total('contrat'),
                    total_instance('user'),
                    read_only('role'),
                    read_only('type_ayant_droit'),
                    read_only('groupe_mutualiste'),
                    read_only('fonction_mutualiste'),
                    ['user:list:mutualiste']
                )
            ],
            [
                'name' => 'Gestion Réclamation',
                'code' => 'gestion_reclamation',
                'description' => 'Responsable du traitement des réclamations des mutualistes. Reçoit, analyse, et classe les plaintes. Suit leur avancement, communique avec les parties concernées, et met à jour les statuts. Peut consulter les données nécessaires (adhésion, prise en charge, cotisation) pour traiter les demandes.',
                'permissions' => Permission::pluck('name')
            ],
            [
                'name' => 'Gestionnaire Finances',
                'code' => 'gestion_finances',
                'description' => 'Gère les flux financiers : caisses, mouvements d’argent, cotisations et remboursements. Suit les soldes, enregistre les paiements et les opérations comptables. Peut consulter l’historique financier des mutualistes et produire des rapports.',
                'permissions' => Permission::pluck('name')
            ],
            [
                'name' => 'Gestionnaire Allocations & Prise en Charge',
                'code' => 'gestion_allocations',
                'description' => 'S’occupe de la définition et du paramétrage des prestations (types, taux, restrictions). Traite les demandes de prise en charge : validation, calcul du montant remboursable et mise à jour du statut. Doit appliquer les règles de couverture en vigueur.',
                'permissions' => Permission::pluck('name')
            ],
            [
                'name' => 'Agent Saisie',
                'code' => 'agent_saisie',
                'description' => 'Utilisateur limité chargé de saisir des données dans le système. Peut créer ou consulter des mutualistes, ayants droit ou opérations simples. Ne peut pas modifier ou valider des données sensibles. Rôle principalement opérationnel et encadré.',
                'permissions' => Permission::pluck('name')
            ],
        ];


    }
}
