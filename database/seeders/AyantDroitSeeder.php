<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AyantDroit;
use App\Models\Mutualiste;
use App\Models\User; // Pour les champs d'audit
use App\Models\TypeAyantDroit; // Pour lier aux types d'ayant droit
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Import Faker

class AyantDroitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: Truncate the table before seeding
        DB::table('ayant_droits')->delete();

        $faker = Faker::create(); // Initialize Faker

        // Récupérer les types d'ayant droit et un utilisateur d'audit
        $typeConjoint = TypeAyantDroit::where('libelle', 'Conjoint')->first();
        $typeEnfant = TypeAyantDroit::where('libelle', 'Enfant')->first();
        $typeMutualiste = TypeAyantDroit::where('libelle', 'Mutualiste')->first();

        // Vérifier si les types d'ayant droit et l'utilisateur admin existent
        if (!$typeConjoint || !$typeEnfant ) {
             $this->command->warn('Impossible de seeder les AyantsDroit : Assurez-vous que les TypesAyantDroit (Conjoint, Enfant) et l\'utilisateur admin existent.');
             return;
        }

        // Récupérer tous les mutualistes
        $mutualistes = Mutualiste::all();

        if ($mutualistes->isEmpty()) {
             $this->command->warn('Aucun Mutualiste trouvé. Impossible de seeder les AyantsDroit.');
             return;
        }

        $ayantsDroitToSeed = [];

        foreach ($mutualistes as $mutualiste) {
            // Créer un ayant droit de type 'Conjoint'
            $ayantsDroitToSeed[] = [
                'id' => $faker->uuid(), // Generate UUID
                'type_ayant_droit_id' => $typeConjoint->id,
                'mutualiste_id' => $mutualiste->id,
                'nom' => $mutualiste->nom, // Usually the same last name as the mutualiste
                'prenom' => $faker->firstName($mutualiste->sexe === 'MASCULIN' ? 'female' : 'male'), // Opposite gender name
                'date_naissance' => $faker->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d'), // Age range for spouse
                'sexe' => $mutualiste->sexe === 'MASCULIN' ? 'FEMININ' : 'MASCULIN', // Opposite sex
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Créer un ayant droit de type 'Enfant'
             $ayantsDroitToSeed[] = [
                'id' => $faker->uuid(), // Generate UUID
                'type_ayant_droit_id' => $typeEnfant->id,
                'mutualiste_id' => $mutualiste->id,
                'nom' => $mutualiste->nom, // Same last name
                'prenom' => $faker->firstName($faker->randomElement(['male', 'female'])), // Random gender name
                'date_naissance' => $faker->dateTimeBetween('-18 years', '-1 years')->format('Y-m-d'), // Age range for child
                'sexe' => $faker->randomElement(['MASCULIN', 'FEMININ']), // Random sex
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Lui-meme
            $ayantsDroitToSeed[] = [
                'id' => $faker->uuid(), // Generate UUID
                'type_ayant_droit_id' => $typeMutualiste->id,
                'mutualiste_id' => $mutualiste->id,
                'nom' => $mutualiste->nom, // Nom de famille (souvent celui du mutualiste)
                'prenom' => $mutualiste->prenom,
                'date_naissance' =>  $mutualiste->date_naissance,
                'sexe' =>  $mutualiste->sexe,
                'est_actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];


        }

        // Insert the generated data
        DB::table('ayant_droits')->insert($ayantsDroitToSeed);

        $this->command->info('AyantsDroit seedés pour tous les mutualistes.');
    }
}
