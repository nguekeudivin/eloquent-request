<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeAllocation;
use App\Models\GroupeMutualiste;
use App\Models\GroupeAllocation;
use App\Models\Allocation;
use App\Models\Mutualiste;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AllocationSeeder extends Seeder
{
    public function run()
    {

        DB::table('type_allocations')->delete();
        DB::table('groupe_allocation')->delete();
        DB::table('allocations')->delete();

        $typeIds = [];
        foreach (self::$types as $key => $data) {
            $type = TypeAllocation::create([
                'libelle' => $data['libelle'],
                'montant_standard' => $data['montant_standard'],
                'montant_min' => $data['montant_min'],
                'montant_max' => $data['montant_max'],
            ]);
            $typeIds[$key] = $type->id;
        }

        foreach (self::$allocationsParGroupe as $nom => $allocations) {
            $groupe = GroupeMutualiste::where('nom', $nom)->first();
            if (!$groupe) {
                continue;
            }

            foreach ($allocations as $typeKey => $montant) {
                GroupeAllocation::updateOrCreate(
                    [
                        'groupe_id' => $groupe->id,
                        'type_allocation_id' => $typeIds[$typeKey],
                    ],
                    [
                        'montant' => $montant,
                    ]
                );
            }
        }

        // Attribuer des allocations a des mutualistes
        $mutualistes = Mutualiste::inRandomOrder()->take(10)->get();
        $types = TypeAllocation::all();
        $statuts = ['ACCORDEE','VERSEE','REFUSEE','ANNULEE'];
        $motifs = [
            'Soutien exceptionnel', 'Événement familial', 'Besoin urgent',
            'Frais médicaux', 'Situation difficile'
        ];

        foreach ($mutualistes as $mutualiste) {
            $groupe = optional(optional($mutualiste->fonction)->groupe)->id;
            if (!$groupe) continue;

            $type = $types->random();

            $groupeAllocation = GroupeAllocation::where([
                'groupe_id' => $groupe,
                'type_allocation_id' => $type->id,
            ])->first();

            if (!$groupeAllocation) continue;

            Allocation::create([
                'id' => Str::uuid(),
                'mutualiste_id' => $mutualiste->id,
                'type_allocation_id' => $type->id,
                'date' => now()->subDays(rand(0, 30)),
                'montant' => $groupeAllocation->montant,
                'motif' => collect($motifs)->random(),
                'statut' => collect($statuts)->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    static $types = [
        'allocation_mariage' => [
            'libelle' => 'Allocation de mariage',
            'montant_standard' => 300000,
            'montant_min' => 200000,
            'montant_max' => 600000,
        ],
        'allocation_naissance' => [
            'libelle' => 'Allocation de naissance',
            'montant_standard' => 160000,
            'montant_min' => 120000,
            'montant_max' => 300000,
        ],
        'allocation_medaille' => [
            'libelle' => 'Allocation de médaille',
            'montant_standard' => 100000,
            'montant_min' => 80000,
            'montant_max' => 200000,
        ],
        'allocation_retraite' => [
            'libelle' => 'Allocation de départ à la retraite',
            'montant_standard' => 250000,
            'montant_min' => 150000,
            'montant_max' => 600000,
        ],
        'prise_en_charge_maladie' => [
            'libelle' => 'Prise en charge des frais de maladie',
            'montant_standard' => 150000,
            'montant_min' => 110000,
            'montant_max' => 250000,
        ],
        'allocation_deces' => [
            'libelle' => 'Allocation en cas de décès',
            'montant_standard' => 200000,
            'montant_min' => 160000,
            'montant_max' => 300000,
        ],
    ];

    static $allocationsParGroupe = [
        'GROUPE 1' => [
            'allocation_mariage' => 600000,
            'allocation_naissance' => 300000,
            'allocation_medaille' => 200000,
            'allocation_retraite' => 600000,
            'prise_en_charge_maladie' => 250000,
            'allocation_deces' => 300000,
        ],
        'GROUPE 2' => [
            'allocation_mariage' => 500000,
            'allocation_naissance' => 250000,
            'allocation_medaille' => 180000,
            'allocation_retraite' => 450000,
            'prise_en_charge_maladie' => 230000,
            'allocation_deces' => 280000,
        ],
        'GROUPE 3' => [
            'allocation_mariage' => 450000,
            'allocation_naissance' => 220000,
            'allocation_medaille' => 160000,
            'allocation_retraite' => 400000,
            'prise_en_charge_maladie' => 210000,
            'allocation_deces' => 260000,
        ],
        'GROUPE 4' => [
            'allocation_mariage' => 400000,
            'allocation_naissance' => 200000,
            'allocation_medaille' => 140000,
            'allocation_retraite' => 350000,
            'prise_en_charge_maladie' => 190000,
            'allocation_deces' => 240000,
        ],
        'GROUPE 5' => [
            'allocation_mariage' => 350000,
            'allocation_naissance' => 180000,
            'allocation_medaille' => 120000,
            'allocation_retraite' => 300000,
            'prise_en_charge_maladie' => 170000,
            'allocation_deces' => 220000,
        ],
        'GROUPE 6' => [
            'allocation_mariage' => 300000,
            'allocation_naissance' => 160000,
            'allocation_medaille' => 100000,
            'allocation_retraite' => 250000,
            'prise_en_charge_maladie' => 150000,
            'allocation_deces' => 200000,
        ],
        'GROUPE 7' => [
            'allocation_mariage' => 250000,
            'allocation_naissance' => 140000,
            'allocation_medaille' => 90000,
            'allocation_retraite' => 200000,
            'prise_en_charge_maladie' => 130000,
            'allocation_deces' => 180000,
        ],
        'GROUPE 8' => [
            'allocation_mariage' => 200000,
            'allocation_naissance' => 120000,
            'allocation_medaille' => 80000,
            'allocation_retraite' => 150000,
            'prise_en_charge_maladie' => 110000,
            'allocation_deces' => 160000,
        ],
        'GROUPE 9' => [
            'allocation_mariage' => 300000,
            'allocation_naissance' => 160000,
            'allocation_medaille' => 100000,
            'allocation_retraite' => 250000,
            'prise_en_charge_maladie' => 150000,
            'allocation_deces' => 200000,
        ],
        'GROUPE 10' => [
            'allocation_mariage' => 250000,
            'allocation_naissance' => 140000,
            'allocation_medaille' => 90000,
            'allocation_retraite' => 200000,
            'prise_en_charge_maladie' => 130000,
            'allocation_deces' => 180000,
        ],
        'GROUPE 11' => [
            'allocation_mariage' => 200000,
            'allocation_naissance' => 120000,
            'allocation_medaille' => 80000,
            'allocation_retraite' => 150000,
            'prise_en_charge_maladie' => 110000,
            'allocation_deces' => 160000,
        ],
    ];

}
