<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caisse;
use App\Models\CategorieEntree;
use App\Models\CategorieSortie;
use App\Models\Entree;
use App\Models\Sortie;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sorties')->delete();
        DB::table('entrees')->delete();
        DB::table('categorie_entrees')->delete();
        DB::table('categorie_entrees')->delete();
        DB::table('caisses')->delete();

        $financeUser = User::where('username', 'super_admin')->first();

        if (!$financeUser) {
             $this->command->warn('User with username "service_finance" not found. Skipping Finance seeding.');
             return;
        }

        $auditFields = [
            'created_by_user_id' => $financeUser->id,
            'updated_by_user_id' => $financeUser->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Seed Categories Entree
        $categoriesEntree = [
            ['libelle' => 'Droits d\'adhésion', 'description' => null, 'est_actif' => true] + $auditFields,
            ['libelle' => 'Cotisations des membres', 'description' => null, 'est_actif' => true] + $auditFields,
            ['libelle' => 'Contributions des membres d\'honneur', 'description' => null, 'est_actif' => true] + $auditFields,
            ['libelle' => 'Produits financiers', 'description' => null, 'est_actif' => true] + $auditFields,
            ['libelle' => 'Recettes vente', 'description' => null, 'est_actif' => true] + $auditFields,
            ['libelle' => 'Bénéfices et Dividentes', 'description' => null, 'est_actif' => true] + $auditFields,
        ];
        DB::table('categorie_entrees')->insert($categoriesEntree);
        $this->command->info('Categories Entree seedées.');


        // Seed Categories Sortie
        $categoriesSortie = [
            ['libelle' => 'Prise en charge Maladie', 'description' => null, 'est_active' => true] + $auditFields,
            ['libelle' => 'Allocation Mariage', 'description' => null, 'est_active' => true] + $auditFields,
            ['libelle' => 'Allocation Naissance', 'description' => null, 'est_active' => true] + $auditFields,
            ['libelle' => 'Allocation Médaille', 'description' => null, 'est_active' => true] + $auditFields,
            ['libelle' => 'Allocation Retraite', 'description' => null, 'est_active' => true] + $auditFields,
            ['libelle' => 'Allocation Décès', 'description' => null, 'est_active' => true] + $auditFields,
        ];
        DB::table('categorie_sorties')->insert($categoriesSortie);
        $this->command->info('Categories Sortie seedées.');


        // Seed Caisses (Bank Accounts)
        $caisses = [
            ['nom' => 'Afriland First Bank', 'description' => 'Compte courant Afriland', 'devise' => 'XAF'] + $auditFields,
            ['nom' => 'BISEC', 'description' => 'Compte d\'épargne Bisec', 'devise' => 'XAF'] + $auditFields,
            ['nom' => 'CCA BANK', 'description' => 'Compte courant CCA', 'devise' => 'XAF'] + $auditFields,
        ];
        DB::table('caisses')->insert($caisses);
        $this->command->info('Caisses (Bank Accounts) seedées.');


        // Fetch created entities
        $allCaisses = Caisse::all();
        $allCategoriesEntree = CategorieEntree::all();
        $allCategoriesSortie = CategorieSortie::all();

        if ($allCaisses->isEmpty() || $allCategoriesEntree->isEmpty() || $allCategoriesSortie->isEmpty()) {
             $this->command->warn('Cannot generate Entrees/Sorties: Caisses, CategoriesEntree, or CategoriesSortie are empty.');
             return;
        }

        // Generate Entrees
        $entreesToSeed = [];
        for ($i = 0; $i < 50; $i++) {
            $randomCaisse = $allCaisses->random();
            $randomCategorie = $allCategoriesEntree->random();
            $entreesToSeed[] = [
                'id' => Str::uuid(),
                'caisse_id' => $randomCaisse->id,
                'categorie_entree_id' => $randomCategorie->id,
                'date_heure_mouvement' => now()->subDays(rand(1, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                // Ensure montant is a multiple of 1000
                'montant' => rand(1, 1000) * 1000,
                'source_motif' => 'Source/Motif Entrée ' . ($i + 1),
                'description' => 'Description entrée ' . ($i + 1),
                'reference_externe' => 'REF-ENT-' . Str::random(5),
                'date_enregistrement' => now(),
                'enregistre_par_admin_id' => $financeUser->id,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_user_id' => $financeUser->id,
                'updated_by_user_id' => $financeUser->id,
            ];
        }
        DB::table('entrees')->insert($entreesToSeed);
        $this->command->info('50 Entrees seedées.');

        // Generate Sorties
        $sortiesToSeed = [];
        for ($i = 0; $i < 50; $i++) {
            $randomCaisse = $allCaisses->random();
            $randomCategorie = $allCategoriesSortie->random();
            $sortiesToSeed[] = [
                'id' => Str::uuid(),
                'caisse_id' => $randomCaisse->id,
                'categorie_sortie_id' => $randomCategorie->id,
                'date_heure_mouvement' => now()->subDays(rand(1, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                 // Ensure montant is a multiple of 1000
                'montant' => rand(1, 500) * 1000,
                'beneficiaire_motif' => 'Bénéficiaire/Motif Sortie ' . ($i + 1),
                'description' => 'Description sortie ' . ($i + 1),
                'reference_externe' => 'REF-SORT-' . Str::random(5),
                'date_enregistrement' => now(),
                'enregistre_par_admin_id' => $financeUser->id,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_user_id' => $financeUser->id,
                'updated_by_user_id' => $financeUser->id,
            ];
        }
        DB::table('sorties')->insert($sortiesToSeed);
        $this->command->info('50 Sorties seedées.');

        $this->command->info('FinanceSeeder terminé.');
    }
}
