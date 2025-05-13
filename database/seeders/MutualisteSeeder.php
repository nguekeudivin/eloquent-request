<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker; // Importer Faker

use App\Models\User;
use App\Models\Mutualiste;
use App\Models\TypeStatut;
use App\Models\UserRole;
use App\Models\Role;

class MutualisteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_FR'); // Créer une instance de Faker (vous pouvez choisir une locale)

        $actifStatus = TypeStatut::where('code_interne', 'USER_ACTIF')
                                   ->where('contexte', 'user')
                                   ->first();

        if (!$actifStatus) {
             $this->command->info('Le statut "USER_ACTIF" (contexte "user") n\'a pas été trouvé. Veuillez exécuter TypeStatutSeeder d\'abord.');
             return;
        }

        // Créer plusieurs utilisateurs qui seront aussi des mutualistes
        for ($i = 0; $i < 10; $i++) { // Créer par exemple 10 mutualistes
             $userData = [
                 'username' => $faker->unique()->userName,
                 'email' => $faker->unique()->safeEmail,
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

             // Créer l'enregistrement mutualiste avec le même ID que l'utilisateur
             Mutualiste::firstOrCreate(
                 ['id' => $user->id],
                 [
                     'id' => $user->id, // Assigner explicitement l'ID de l'utilisateur
                     'numero_adherent' => $faker->unique()->numerify('MUT-######'), // Numéro d'adhérent unique
                     'nom' => $faker->lastName,
                     'prenom' => $faker->firstName,
                     'date_naissance' => $faker->date('Y-m-d', '-30 years'), // Date de naissance il y a max 30 ans
                     'lieu_naissance' => $faker->city,
                     'sexe' => $faker->randomElement(['H', 'F', 'Autre', null]),
                     'adresse' => $faker->address,
                     'telephone' => $faker->phoneNumber,
                     'profession' => $faker->jobTitle,
                     'date_premiere_adhesion' => $faker->date('Y-m-d', '-5 years'), // Date de première adhésion il y a max 5 ans
                     // created_at, updated_at gérés par timestamps()
                     // created_by_user_id et updated_by_user_id seront null par défaut si non spécifiés
                 ]
             );
        }
    }
}
