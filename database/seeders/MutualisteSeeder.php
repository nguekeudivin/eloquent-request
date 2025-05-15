<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Mutualiste;
use App\Models\StatusType;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\FonctionMutualiste;
use App\Models\GroupeMutualiste;
use App\Models\Adhesion;

class MutualisteSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('fonction_mutualistes')->delete();
        DB::table('mutualistes')->delete();
        DB::table('adhesions')->delete();

        $faker = Faker::create('fr_FR');

        // Definir un status pour notre utilisateur.
        $actifStatus = StatusType::where('code_interne', 'USER_ACTIF')
                                   ->where('contexte', 'user')
                                   ->first();
        if (!$actifStatus) {
             $this->command->info('Le statut "USER_ACTIF" (contexte "user") n\'a pas été trouvé. Veuillez exécuter StatusTypeSeeder d\'abord.');
             return;
        }

        foreach(self::$fonctions as $fonctionData) {


            $fonction = FonctionMutualiste::create([
                'libelle' => $fonctionData["fonction"],
                'groupe_mutualiste_id' => GroupeMutualiste::where("nom", $fonctionData['groupe'])->first()->id
            ]);

            foreach($fonctionData['mutualistes'] as $item){

                $userData = [
                    'username' => Str::slug($item['name'],"_"),
                    'email' => Str::lower(Str::replace(" ","", $item['name'])),
                    'password' => Hash::make('password'),
                    'statut_id' => $actifStatus->id,
                    'email_verified_at' => Carbon::now(),
                    'last_connexion' => $faker->boolean(80) ? Carbon::parse($faker->dateTimeBetween('-1 year', 'now'))->toDateTimeString() : null, // 80% de chance d'avoir une date de dernière connexion
                ];

                $user = User::firstOrCreate(['email' => $userData['email']], $userData);

               // Create a role
               UserRole::create([
                   'user_id' => $user->id,
                   'role_id' => Role::where('name','mutualiste')->first()->id
               ]);

               $nameParts = explode(" ",$item['name']);

                // Créer l'enregistrement mutualiste avec le même ID que l'utilisateur
               $mutualiste = Mutualiste::firstOrCreate(
                    ['id' => $user->id],
                    [
                        'id' => $user->id, // Assigner explicitement l'ID de l'utilisateur
                        'numero_adherent' => $faker->unique()->numerify('MUT-######'), // Numéro d'adhérent unique
                        'nom' => $nameParts[1],
                        'prenom' => $nameParts[0],
                        'date_naissance' => $faker->date('Y-m-d', '-30 years'), // Date de naissance il y a max 30 ans
                        'lieu_naissance' => $faker->city,
                        'sexe' => $faker->randomElement(['MASCULIN', 'FEMININ']),
                        'adresse' => $faker->address,
                        'telephone' => $faker->phoneNumber,
                        'profession' => $faker->jobTitle,
                        'fonction_mutualiste_id' => $fonction->id,
                        'date_premiere_adhesion' => $faker->date('Y-m-d', '-5 years'), // Date de première adhésion il y a max 5 ans
                    ]
                );

                // Rechercher un contrat d'adhesion et l'entregistre sous ce contrat.
                $contrat = $mutualiste->fonction->groupe->contrats[0];
                Adhesion::create([
                    'contrat_id' => $contrat->id,
                    'mutualiste_id' => $mutualiste->id,
                    'date_debut' => now(),
                    'statut' => 'ACTIF'
                ]);
            }


        }

    }

    static $fonctions = [
        [
            'fonction' => 'Directeur Général',
            'groupe' => 'GROUPE 01',
            'mutualistes' => [
                ['name' => 'Jean Mvondo', 'fonction' => 'Directeur Général'],
                ['name' => 'Pauline Ndongo', 'fonction' => 'Directeur Général'],
            ],
        ],
        [
            'fonction' => 'Directeur',
            'groupe' => 'GROUPE 02',
            'mutualistes' => [
                ['name' => 'Arnaud Nkou', 'fonction' => 'Directeur'],
                ['name' => 'Clarisse Fopa', 'fonction' => 'Directeur'],
            ],
        ],
        [
            'fonction' => 'Chef de Division',
            'groupe' => 'GROUPE 02',
            'mutualistes' => [
                ['name' => 'Didier Mbarga', 'fonction' => 'Chef de Division'],
                ['name' => 'Rosine Nnomo', 'fonction' => 'Chef de Division'],
            ],
        ],
        [
            'fonction' => 'Directeur Adjoint',
            'groupe' => 'GROUPE 03',
            'mutualistes' => [
                ['name' => 'Boris Tchounga', 'fonction' => 'Directeur Adjoint'],
                ['name' => 'Estelle Ngono', 'fonction' => 'Directeur Adjoint'],
            ],
        ],
        [
            'fonction' => 'Directeur Adjoint Assimilé',
            'groupe' => 'GROUPE 03',
            'mutualistes' => [
                ['name' => 'Cédric Abega', 'fonction' => 'Directeur Adjoint Assimilé'],
                ['name' => 'Fanny Etoundi', 'fonction' => 'Directeur Adjoint Assimilé'],
            ],
        ],
        [
            'fonction' => 'Sous-Directeurs',
            'groupe' => 'GROUPE 04',
            'mutualistes' => [
                ['name' => 'Kevin Talla', 'fonction' => 'Sous-Directeurs'],
                ['name' => 'Brigitte Biloa', 'fonction' => 'Sous-Directeurs'],
            ],
        ],
        [
            'fonction' => 'Chefs de Cellule',
            'groupe' => 'GROUPE 04',
            'mutualistes' => [
                ['name' => 'Marceline Etoa', 'fonction' => 'Chefs de Cellule'],
                ['name' => 'Valentin Ebogo', 'fonction' => 'Chefs de Cellule'],
            ],
        ],
        [
            'fonction' => 'Chargés d’Etudes',
            'groupe' => 'GROUPE 04',
            'mutualistes' => [
                ['name' => 'Rachel Ebanda', 'fonction' => 'Chargés d’Etudes'],
                ['name' => 'Samuel Fotso', 'fonction' => 'Chargés d’Etudes'],
            ],
        ],
        [
            'fonction' => 'Chargés d’Etudes Assimilés',
            'groupe' => 'GROUPE 04',
            'mutualistes' => [
                ['name' => 'Patricia Mekoulou', 'fonction' => 'Chargés d’Etudes Assimilés'],
                ['name' => 'Lionel Zambo', 'fonction' => 'Chargés d’Etudes Assimilés'],
            ],
        ],
        [
            'fonction' => 'Chefs de services',
            'groupe' => 'GROUPE 05',
            'mutualistes' => [
                ['name' => 'Hervé Ngo', 'fonction' => 'Chefs de services'],
                ['name' => 'Tatiana Mengue', 'fonction' => 'Chefs de services'],
            ],
        ],
        [
            'fonction' => "Chargés d'Etudes Assistants",
            'groupe' => 'GROUPE 05',
            'mutualistes' => [
                ['name' => 'François Eloundou', 'fonction' => "Chargés d'Etudes Assistants"],
                ['name' => 'Yvonne Douala', 'fonction' => "Chargés d'Etudes Assistants"],
            ],
        ],
        [
            'fonction' => "Chargés d'Etudes Assistants Assimilés",
            'groupe' => 'GROUPE 05',
            'mutualistes' => [
                ['name' => 'Pierre Biya', 'fonction' => "Chargés d'Etudes Assistants Assimilés"],
                ['name' => 'Sylvie Nguea', 'fonction' => "Chargés d'Etudes Assistants Assimilés"],
            ],
        ],
        [
            'fonction' => 'Chefs de Bureaux',
            'groupe' => 'GROUPE 06',
            'mutualistes' => [
                ['name' => 'Gustave Nsom', 'fonction' => 'Chefs de Bureaux'],
                ['name' => 'Nadine Mfegue', 'fonction' => 'Chefs de Bureaux'],
            ],
        ],
        [
            'fonction' => 'Cadres « A »',
            'groupe' => 'GROUPE 06',
            'mutualistes' => [
                ['name' => 'Eric Ndedi', 'fonction' => 'Cadres « A »'],
                ['name' => 'Chantal Abessolo', 'fonction' => 'Cadres « A »'],
            ],
        ],
        [
            'fonction' => 'Cadres Contractuels des Catégories 10 et plus',
            'groupe' => 'GROUPE 06',
            'mutualistes' => [
                ['name' => 'Mireille Ndongo', 'fonction' => 'Cadres Contractuels des Catégories 10 et plus'],
                ['name' => 'Roger Djomo', 'fonction' => 'Cadres Contractuels des Catégories 10 et plus'],
            ],
        ],
        [
            'fonction' => 'Fonctionnaires de « B »',
            'groupe' => 'GROUPE 07',
            'mutualistes' => [
                ['name' => 'Thérèse Oyono', 'fonction' => 'Fonctionnaires de « B »'],
                ['name' => 'Michel Momo', 'fonction' => 'Fonctionnaires de « B »'],
            ],
        ],
        [
            'fonction' => 'Cadres Contractuels Catégories 7',
            'groupe' => 'GROUPE 07',
            'mutualistes' => [
                ['name' => 'Daniel Fopa', 'fonction' => 'Cadres Contractuels Catégories 7'],
                ['name' => 'Marina Tonye', 'fonction' => 'Cadres Contractuels Catégories 7'],
            ],
        ],
        [
            'fonction' => 'Cadres Contractuels Catégories 8',
            'groupe' => 'GROUPE 07',
            'mutualistes' => [
                ['name' => 'Léon Tamba', 'fonction' => 'Cadres Contractuels Catégories 8'],
                ['name' => 'Cynthia Ewodo', 'fonction' => 'Cadres Contractuels Catégories 8'],
            ],
        ],
        [
            'fonction' => 'Cadres Contractuels Catégories 9',
            'groupe' => 'GROUPE 07',
            'mutualistes' => [
                ['name' => 'Marc Ngalle', 'fonction' => 'Cadres Contractuels Catégories 9'],
                ['name' => 'Jessica Owona', 'fonction' => 'Cadres Contractuels Catégories 9'],
            ],
        ],
        [
            'fonction' => 'Fonctionnaires de « C »',
            'groupe' => 'GROUPE 08',
            'mutualistes' => [
                ['name' => 'Christian Biyong', 'fonction' => 'Fonctionnaires de « C »'],
                ['name' => 'Aline Kamdem', 'fonction' => 'Fonctionnaires de « C »'],
            ],
        ],
        [
            'fonction' => 'Agents décisionnaires',
            'groupe' => 'GROUPE 08',
            'mutualistes' => [
                ['name' => 'Lucien Etondi', 'fonction' => 'Agents décisionnaires'],
                ['name' => 'Sabine Mbeng', 'fonction' => 'Agents décisionnaires'],
            ],
        ],
        [
            'fonction' => 'Retraité De Catégories « A », 10 et plus',
            'groupe' => 'GROUPE 09',
            'mutualistes' => [
                ['name' => 'Henri Eba', 'fonction' => 'Retraité De Catégories « A », 10 et plus'],
                ['name' => 'Yvette Eboutou', 'fonction' => 'Retraité De Catégories « A », 10 et plus'],
            ],
        ],
        [
            'fonction' => 'Retraité De Catégories « B », 7',
            'groupe' => 'GROUPE 10',
            'mutualistes' => [
                ['name' => 'André Talla', 'fonction' => 'Retraité De Catégories « B », 7'],
                ['name' => 'Madeleine Ebanga', 'fonction' => 'Retraité De Catégories « B », 7'],
            ],
        ],
        [
            'fonction' => 'Retraité De Catégories « B », 8',
            'groupe' => 'GROUPE 10',
            'mutualistes' => [
                ['name' => 'Germain Koum', 'fonction' => 'Retraité De Catégories « B », 8'],
                ['name' => 'Florence Dipoko', 'fonction' => 'Retraité De Catégories « B », 8'],
            ],
        ],
        [
            'fonction' => 'Retraité De Catégories « B », 9',
            'groupe' => 'GROUPE 10',
            'mutualistes' => [
                ['name' => 'Noël Tchouankep', 'fonction' => 'Retraité De Catégories « B », 9'],
                ['name' => 'Esther Ngo Mback', 'fonction' => 'Retraité De Catégories « B », 9'],
            ],
        ],
        [
            'fonction' => 'Retraité De Catégories « C »',
            'groupe' => 'GROUPE 11',
            'mutualistes' => [
                ['name' => 'Claude Abessolo', 'fonction' => 'Retraité De Catégories « C »'],
                ['name' => 'Georgette Nlend', 'fonction' => 'Retraité De Catégories « C »'],
            ],
        ],
        [
            'fonction' => 'Retraité De Catégories « D »',
            'groupe' => 'GROUPE 11',
            'mutualistes' => [
                ['name' => 'Pascal Mbida', 'fonction' => 'Retraité De Catégories « D »'],
                ['name' => 'Julienne Mvogo', 'fonction' => 'Retraité De Catégories « D »'],
            ],
        ],
        [
            'fonction' => 'Retraité De Catégories Agents décisionnaires',
            'groupe' => 'GROUPE 11',
            'mutualistes' => [
                ['name' => 'Jacques Ewanga', 'fonction' => 'Retraité De Catégories Agents décisionnaires'],
                ['name' => 'Martine Mvila', 'fonction' => 'Retraité De Catégories Agents décisionnaires'],
            ],
        ],
    ];


}
