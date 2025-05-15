<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeAyantDroit;
use App\Models\User; // Pour les champs d'audit
use Illuminate\Support\Facades\DB;

class TypeAyantDroitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_ayant_droits')->delete();

        $typesToSeed = [
            [
                'libelle' => 'Conjoint',
                'description' => 'Époux ou partenaire enregistré légalement.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'libelle' => 'Enfant',
                'description' => 'Enfant à charge (biologique, adopté ou beau-fils/fille) sous un certain âge.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'libelle' => 'Mutualiste',
                'description' => 'Le mutualiste lui-meme est considere comme un ayant droit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'libelle' => 'Parent',
                'description' => 'Un parent à charge du mutuaslite',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        if (!empty($typesToSeed)) {
             TypeAyantDroit::insert($typesToSeed);
             $this->command->info('TypesAyantDroit seedés.');
        } else {
             $this->command->info('Aucun TypeAyantDroit à seeder.');
        }
    }
}
