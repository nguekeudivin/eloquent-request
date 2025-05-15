<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeAllocation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TypeAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types_allocation')->truncate();

        $adminUser = User::where('username', 'super_admin')->first();

        $typesToSeed = [

            [
                'libelle' => 'Allocation Mariage',
                'montant_standard' => 150000.00,
                'montant_max' => 200000.00,
                'montant_min' => 100000.00,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_user_id' => $adminUser ? $adminUser->id : null,
                'updated_by_user_id' => $adminUser ? $adminUser->id : null,
            ],
            [
                'libelle' => 'Allocation Naissance',
                'montant_standard' => 100000.00,
                'montant_max' => 150000.00,
                'montant_min' => 75000.00,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_user_id' => $adminUser ? $adminUser->id : null,
                'updated_by_user_id' => $adminUser ? $adminUser->id : null,
            ],
            [
                'libelle' => 'Allocation Médaille', // Assuming a type of achievement medal
                'montant_standard' => 50000.00,
                'montant_max' => 100000.00,
                'montant_min' => 25000.00,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_user_id' => $adminUser ? $adminUser->id : null,
                'updated_by_user_id' => $adminUser ? $adminUser->id : null,
            ],
            [
                'libelle' => 'Allocation Retraite',
                'montant_standard' => 1000000.00,
                'montant_max' => 2000000.00,
                'montant_min' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_user_id' => $adminUser ? $adminUser->id : null,
                'updated_by_user_id' => $adminUser ? $adminUser->id : null,
            ],
            [
                'libelle' => 'Allocation Décès (Générique)',
                'montant_standard' => 300000.00,
                'montant_max' => 750000.00,
                'montant_min' => 150000.00,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_user_id' => $adminUser ? $adminUser->id : null,
                'updated_by_user_id' => $adminUser ? $adminUser->id : null,
            ],
        ];

        TypeAllocation::insert($typesToSeed);

        $this->command->info('TypesAllocation seedés.');
    }
}
