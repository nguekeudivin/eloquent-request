<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AyantDroit;
use App\Models\Mutualiste;
use App\Models\TypeAyantDroit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class AyantDroitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ayant_droits')->delete();

        // Récupérer des exemples de Mutualistes, Types d'AyantDroit et un utilisateur d'audit
        // Assurez-vous que ces seeders ont été exécutés.
        $mutualiste1 = Mutualiste::first(); // Premier mutualiste
        $mutualiste2 = Mutualiste::skip(1)->first(); // Deuxième mutualiste

        $typeConjoint = TypeAyantDroit::where('libelle', 'Conjoint')->first();
        $typeEnfant = TypeAyantDroit::where('libelle', 'Enfant')->first();

        $adminUser = User::where('username', 'super_admin')->first(); // Utilisateur pour l'audit

        if (!$mutualiste1 || !$mutualiste2 || !$typeConjoint || !$typeEnfant) {
             $this->command->warn('Impossible de seeder les AyantsDroit : Assurez-vous que les Mutualistes, TypesAyantDroit et Users nécessaires existent.');
             return;
        }

        $items = [];

        // Ayant droit pour mutualiste 1
        $items[] = [
            'type_ayant_droit_id' => $typeConjoint->id,
            'mutualiste_id' => $mutualiste1->id,
            'nom' => 'Dupont', // Nom de famille (souvent celui du mutualiste)
            'prenom' => 'Alain',
            'date_naissance' => '1992-08-25',
            'sexe' => 'MASCULIN',
            'est_actif' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by_user_id' => $adminUser ? $adminUser->id : null,
            'updated_by_user_id' => $adminUser ? $adminUser->id : null,
        ];

        $items[] = [
            'type_ayant_droit_id' => $typeEnfant->id,
            'mutualiste_id' => $mutualiste1->id,
            'nom' => 'Dupont',
            'prenom' => 'Chloé',
            'date_naissance' => '2018-04-10',
            'sexe' => 'FEMININ',
            'est_actif' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by_user_id' => $adminUser ? $adminUser->id : null,
            'updated_by_user_id' => $adminUser ? $adminUser->id : null,
        ];

        // Ayant droit pour mutualiste 2 (exemple inactif)
        $items[] = [
            'type_ayant_droit_id' => $typeConjoint->id,
            'mutualiste_id' => $mutualiste2->id,
            'nom' => 'Traore',
            'prenom' => 'Aïcha',
            'date_naissance' => '1988-12-01',
            'sexe' => 'FEMININ',
            'est_actif' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by_user_id' => $adminUser ? $adminUser->id : null,
            'updated_by_user_id' => $adminUser ? $adminUser->id : null,
        ];


        // Insertion de masse pour de meilleures performances
        if (!empty($items)) {

            foreach($items as $item){
                AyantDroit::create($item);
            }

             $this->command->info('AyantsDroit seedés.');
        } else {
             $this->command->info('Aucun AyantDroit à seeder.');
        }
    }
}
