<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contrat;
use App\Models\User;
use App\Models\GroupeMutualiste;
use App\Models\GroupeContrat;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;

class ContratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contrats')->delete();
        DB::table('groupe_mutualistes')->delete();

        foreach(self::$groupes as $groupName => $amount){

            // Creer le groupe.
            $groupe = GroupeMutualiste::create([
                'nom' => $groupName,
            ]);

            // Creer un contrat pour ce groupe
            $contrat = Contrat::create([
                'nom' => 'Contrat Adhesion '.$groupName,
                'description' => "Contract de base pour les adherentes du groupe ".$groupName,
                'date_debut_validite' => '2024-01-01',
                'date_fin_validite' => null,
                'montant_cotisation_base' => $amount['cotisationAmount'],
                'montant_adhesion' => $amount['adhesionAmount'],
                'periode_cotisation' => "ANNUEL",
                'est_actif'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Attributer le contrat au groupe
            GroupeContrat::create([
                'groupe_id' => $groupe->id,
                'contrat_id' => $contrat->id
            ]);
        }

    }

    static $groupes = [
        'GROUPE 01' => [
            'adhesionAmount' => 100000,
            'cotisationAmount' => 100000,
        ],
        'GROUPE 02' => [
            'adhesionAmount' => 75000,
            'cotisationAmount' => 75000,
        ],
        'GROUPE 03' => [
            'adhesionAmount' => 60000,
            'cotisationAmount' => 60000,
        ],
        'GROUPE 04' => [
            'adhesionAmount' => 50000,
            'cotisationAmount' => 50000,
        ],
        'GROUPE 05' => [
            'adhesionAmount' => 40000,
            'cotisationAmount' => 40000,
        ],
        'GROUPE 06' => [
            'adhesionAmount' => 30000,
            'cotisationAmount' => 30000,
        ],
        'GROUPE 07' => [
            'adhesionAmount' => 20000,
            'cotisationAmount' => 20000,
        ],
        'GROUPE 08' => [
            'adhesionAmount' => 10000,
            'cotisationAmount' => 10000,
        ],
        'GROUPE 09' => [
            'adhesionAmount' => 10000,
            'cotisationAmount' => 10000,
        ],
        'GROUPE 10' => [
            'adhesionAmount' => 10000,
            'cotisationAmount' => 10000,
        ],
        'GROUPE 11' => [
            'adhesionAmount' => 10000,
            'cotisationAmount' => 10000,
        ],
    ];
}
