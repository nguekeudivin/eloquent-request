<?php

namespace Database\Seeders;

use App\Models\Adhesion;
use App\Models\Cotisation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CotisationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cotisations')->delete();

        $faker = \Faker\Factory::create('fr_FR');
        $statuts = ['DUE', 'PAYEE', 'PARTIELLE', 'EN RETARD', 'ANNULEE'];

        // Récupère toutes les adhésions avec leurs contrats
        $adhesions = Adhesion::with('contrat')->get();

        foreach ($adhesions as $adhesion) {
            $contrat = $adhesion->contrat;

            if (!$contrat || $contrat->periode_cotisation !== 'ANNUEL') {
                continue; // On ne gère ici que les cotisations annuelles
            }

            // Génère 3 années de cotisations pour test (2022, 2023, 2024)
            for ($i = 0; $i < 3; $i++) {
                $annee = Carbon::now()->year - $i;
                $periode = (string) $annee;

                $statut = $statuts[array_rand($statuts)];
                $montantPrevu = $contrat->montant_cotisation_base;
                $montantPaye = 0;
                $datePaiementEffective = null;

                // Montant payé selon le statut
                switch ($statut) {
                    case 'PAYEE':
                        $montantPaye = $montantPrevu;
                        $datePaiementEffective = Carbon::create($annee, 3, 15);
                        break;
                    case 'PARTIELLE':
                        $montantPaye = $montantPrevu * 0.5;
                        $datePaiementEffective = Carbon::create($annee, 4, 1);
                        break;
                    case 'EN RETARD':
                        $montantPaye = 0;
                        $datePaiementEffective = null;
                        break;
                    case 'ANNULEE':
                        $montantPaye = 0;
                        break;
                    case 'DUE':
                        $montantPaye = 0;
                        break;
                }

                // Création de la cotisation
                Cotisation::create([
                    'id' => Str::uuid(),
                    'adhesion_id' => $adhesion->id,
                    'periode_concerne' => $periode,
                    'montant_prevu' => $montantPrevu,
                    'montant_paye' => $montantPaye,
                    'date_limite_paiement' => Carbon::create($annee, 3, 31),
                    'date_paiement_effective' => $datePaiementEffective,
                    'statut' => $statut,
                    'reference_externe' => Str::random(10),
                    'created_by_user_id' => $adhesion->created_by_user_id,
                    'updated_by_user_id' => $adhesion->updated_by_user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
