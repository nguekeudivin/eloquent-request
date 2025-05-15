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
            ],
            [
                'name' => 'Gestion Reclammation',
                'code' => 'gestion_reclammation',
                'description' => 'Est charge de gerer les reclammations',
                'permissions' => [
                    'reclamation:list',
                    'reclamation:view',
                    "reclamation:view:*",
                    'reclamation:create',
                    'reclamation:create:*',
                    'reclamation:update',
                    'reclamation:update:*',
                    'reclamation:delete',
                    'conversation:list',
                    'conversation:view',
                    "conversation:view:*",
                    'conversation:create',
                    'conversation:create:*',
                    'conversation:update',
                    'conversation:update:*',
                    'conversation:delete',
                    'message:list',
                    'message:view',
                    "message:view:*",
                    'message:create',
                    'message:create:*',
                    'message:update',
                    'message:update:*',
                    'message:delete',
                    'conversation_participant:list',
                    'conversation_participant:view',
                    "conversation_participant:view:*",
                    'conversation_participant:create',
                    'conversation_participant:create:*',
                    'conversation_participant:update',
                    'conversation_participant:update:*',
                    'conversation_participant:delete',
                    'user:view',
                    "user:view:*",
                    'mutualiste:view',
                    "mutualiste:view:*",
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
                RolePermission::firstOrCreate([
                    'role_id' => $role->id,
                    'permission_id' => Permission::where('name',$permisionName)->first()->id
                ]);
            }
        }

        $this->command->info('Rôles seedés.');
    }

    static $roles = [
        [
            'name' => 'Super Administrateur',
            'code' => 'super_admin',
            'description' => 'Ce rôle détient le niveau d\'accès le plus élevé dans le système. Le Super Administrateur a un contrôle total sur toutes les fonctionnalités, les données et la configuration du système. Ses responsabilités incluent la gestion des utilisateurs (création, modification, suppression), l\'attribution des rôles et des permissions, la configuration des paramètres globaux de l\'application, la surveillance de l\'activité du système, la gestion des sauvegardes et la résolution des problèmes techniques complexes. Ce rôle est généralement réservé à un nombre très limité de personnes clés en raison de l\'étendue de ses privilèges.',
        ],
        [
            'name' => 'Mutualiste',
            'code' => 'mutualiste',
            'description' => 'Ce rôle représente l\'utilisateur final de la mutuelle, c\'est-à-dire le membre adhérent. Un mutualiste a accès à son espace personnel au sein de l\'application. Il peut consulter ses informations personnelles, les détails de son adhésion et de son contrat, l\'historique de ses cotisations et paiements, les allocations reçues, les demandes de prise en charge soumises et leur statut, ainsi que ses réclamations et les conversations associées. Le mutualiste peut également effectuer certaines opérations qui le concernent directement, comme soumettre de nouvelles demandes de prise en charge, des demandes d\'allocation, des réclamations, ou envoyer des messages dans les conversations auxquelles il participe. L\'accès est strictement limité à ses propres données et aux actions qu\'il est autorisé à initier.',
        ],
        [
            'name' => 'Gestion Mutualiste',
            'code' => 'gestion_mutualiste',
            'description' => 'Ce rôle est attribué aux administrateurs ou employés de la mutuelle chargés de gérer le portefeuille des membres. Les responsabilités principales incluent l\'enregistrement de nouveaux mutualistes et de leurs ayants droit, la mise à jour de leurs informations personnelles et de contact, la gestion de leurs adhésions (création, modification, résiliation, suspension, réactivation), le suivi des cotisations dues et payées, la gestion des groupes mutualistes et des fonctions occupées par les membres. Les détenteurs de ce rôle peuvent également consulter l\'historique complet des interactions d\'un mutualiste avec la mutuelle (prises en charge, allocations, réclamations, conversations) pour fournir un support ou un suivi.',
        ],
        [
            'name' => 'Gestion Réclamation',
            'code' => 'gestion_réclamation',
            'description' => 'Ce rôle est destiné aux membres du personnel responsables du traitement des plaintes et demandes formelles soumises par les mutualistes. Les tâches incluent la réception et la revue des nouvelles réclamations, leur classification, l\'assignation des réclamations aux agents ou départements appropriés, le suivi de leur progression, la communication avec le mutualiste et les autres parties prenantes, la mise à jour du statut de la réclamation (en cours, résolue, escaladée, fermée), et l\'enregistrement de la résolution finale. Les gestionnaires de réclamations ont besoin d\'accéder aux informations pertinentes du mutualiste et potentiellement aux détails des prises en charge, allocations ou cotisations si la réclamation y est liée.',
        ],
        [
            'name' => 'Gestionnaire Finances',
            'code' => 'gestion_finances',
            'description' => 'Ce rôle est attribué au personnel en charge des opérations financières de la mutuelle. Les responsabilités couvrent la gestion des caisses (comptes bancaires), l\'enregistrement précis de toutes les entrées et sorties d\'argent, la classification des mouvements financiers selon les catégories prédéfinies, le suivi du solde des caisses, la gestion des cotisations (génération, suivi des paiements), l\'enregistrement des paiements reçus, et l\'initiation et le suivi des remboursements de prises en charge. Ce rôle nécessite un accès détaillé aux données financières et la capacité d\'enregistrer des transactions.',
        ],
        [
            'name' => 'Gestionnaire Prestations & Prise en Charge',
            'code' => 'gestion_prestations_pec',
            'description' => 'Ce rôle est attribué aux personnes responsables de la gestion des offres de prestations et du traitement des demandes de prise en charge. Leurs tâches incluent la définition et la mise à jour des types de prestation et des prestations elles-mêmes, la configuration des modalités de remboursement (taux, conditions), l\'application de restrictions sur certaines prestations pour des mutualistes spécifiques, l\'évaluation et la validation (ou le refus) des demandes de prise en charge soumises par les mutualistes, le calcul du montant à rembourser, et le marquage des demandes comme remboursées une fois le paiement effectué. Ce rôle nécessite une connaissance approfondie des règles de couverture et des processus de traitement des demandes.',
        ],
        [
            'name' => 'Agent Saisie',
            'code' => 'agent_saisie',
            'description' => 'Ce rôle est conçu pour le personnel dont la fonction principale est l\'enregistrement de données dans le système. L\'Agent Saisie a des permissions limitées principalement axées sur la création et la consultation d\'enregistrements. Par exemple, il pourrait être autorisé à enregistrer de nouvelles adhésions, de nouveaux ayants droit, ou des mouvements d\'entrée/sortie de caisse simples, ainsi qu\'à consulter les informations existantes. Il n\'a généralement pas les permissions pour modifier ou supprimer des enregistrements sensibles, ni pour effectuer des opérations de validation ou de gestion complexes.',
        ],
    ];

}
