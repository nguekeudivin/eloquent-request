<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\TypePrestation;
use App\Models\TypeAyantDroit;
use App\Models\ModaliteRemboursement;
use App\Models\Mutualiste;
use App\Models\Adhesion;
use App\Models\PriseEnCharge;
use App\Models\Remboursement;
use App\Models\RestrictionPrestation;

class PrestationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_prestations')->delete();
        DB::table("modalite_remboursements")->delete();
        DB::table('prise_en_charges')->delete();
        DB::table("remboursements")->delete();
        DB::table("restriction_prestations")->delete();


        $faker = \Faker\Factory::create('fr_FR');
        $users = User::pluck('id')->toArray();

        // Étape 1 : Création des types de prestations
        $prestationsData = [
            'Consultation',
            'Frais pharmaceutiques',
            'Frais d’hospitalisation',
            'Soins dentaires',
            'Analyses médicales',
            'Les verres médicaux',
        ];

        $typesPrestation = collect();
        foreach ($prestationsData as $libelle) {
            $typesPrestation->push(
                TypePrestation::Create(
                    ['libelle' => $libelle]
                )
            );
        }

        // Étape 2 : Récupération des types d’ayant droit existants
        $typesAyantDroit = TypeAyantDroit::whereIn('libelle', ['Mutualiste', 'Conjoint', 'Enfant'])->get()->keyBy('libelle');

        // Étape 3 : Création des modalités avec les taux fixes
        $tauxParTypeSoins = [
            // index => [public, privé]
            0 => [50, 50], // Consultation
            1 => [50, 50], // Frais pharmaceutiques
            2 => [40, 20], // Hospitalisation
            3 => [25, 15], // Soins dentaires
            4 => [30, 20], // Analyses médicales
            5 => [50, 50], // Verres médicaux
        ];

        foreach ($typesPrestation as $index => $typePrestation) {
            foreach (['Mutualiste', 'Conjoint', 'Enfant'] as $libelleAyantDroit) {
                $typeAyantDroit = $typesAyantDroit->get($libelleAyantDroit);

                if ($typeAyantDroit) {
                    ModaliteRemboursement::firstOrCreate(
                        [
                            'type_prestation_id' => $typePrestation->id,
                            'type_ayant_droit_id' => $typeAyantDroit->id,
                        ],
                        [
                            'taux_hopital_public' => $tauxParTypeSoins[$index][0],
                            'taux_hopital_prive' => $tauxParTypeSoins[$index][1],
                        ]
                    );
                }
            }
        }

        // Selectionner 20 mutuaslites
        $mutualistes = Mutualiste::inRandomOrder()->take(20)->get();
        $admin = User::where('username','super_admin')->first();

        foreach ($mutualistes as $mutualiste) {
            $typePrestation = $typesPrestation->random();
            $ayant_droit = $mutualiste->ayant_droits->random();

            // Créer une prise en charge pour cette prestation

            // Verifier qu'une adhesion existe
            $adhesion = Adhesion::where('mutualiste_id', $mutualiste->id)->first();
            if (!$adhesion) continue;

            $statuts = ['SOUMISE', 'EN COURS', 'VALIDEE', 'REMBOURSEE', 'REFUSEE', 'ANNULEE'];

            PriseEnCharge::create([
                'id' => Str::uuid(),
                'reference' => strtoupper(Str::random(10)),
                'date_soins_facture' => now()->subDays(rand(1, 60)),
                'mutualiste_id' => $mutualiste->id,
                'type_prestation_id' => $typePrestation->id,
                'ayant_droit_id' => $ayant_droit->id,
                'adhesion_id' => $adhesion->id,
                'hopital' => $faker->randomElement(['PUBLIC','PRIVE']),
                'montant_facture' => $faker->randomFloat(2, 5000, 100000),
                'date_soumission' => now()->subDays(rand(1, 10)),
                'date_mise_a_jour_statut' => now(),
                'statut' => $faker->randomElement($statuts),
                'soumise_par_user_id' => $mutualiste->id,
            ]);
        }

        // Sélectionner 10 prises en charge et appliquer un remboursement
        $prises = PriseEnCharge::inRandomOrder()->take(10)->get();
        foreach ($prises as $prise) {
            $modalite = ModaliteRemboursement::inRandomOrder()->first();

            Remboursement::create([
                'id' => Str::uuid(),
                'prise_en_charge_id' => $prise->id,
                'modalite_remboursement_id' => $modalite->id,
                'date_paiement' => now()->subDays(rand(1, 30)),
                'montant_paye' => $faker->randomFloat(2, 1000, $prise->montant_facture),
                'mode_paiement' => $faker->randomElement(['VIREMENT BANCAIRE', 'CHEQUE', 'ESPECES CAISSE']),
                'reference_transaction' => strtoupper(Str::random(12)),
                'paye_par_admin_id' => $admin->id
            ]);
        }

        // Restreindre 5 mutualistes à un type de prestation
        $restrictedMutualistes = Mutualiste::inRandomOrder()->take(5)->get();

        foreach ($restrictedMutualistes as $mutualiste) {
            $typePrestation = $typesPrestation->random();

            RestrictionPrestation::create([
                'id' => Str::uuid(),
                'mutualiste_id' => $mutualiste->id,
                'type_prestation_id' => $typePrestation->id,
                'date_expiration' => now()->addMonths(rand(1, 12)),
            ]);
        }
    }
}
