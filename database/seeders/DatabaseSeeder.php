<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            StatusTypeSeeder::class,
            TypeAyantDroitSeeder::class,
            AdminSeeder::class,
            ContratSeeder::class,
            MutualisteSeeder::class,
            NotificationSeeder::class,
            CotisationSeeder::class,
            AyantDroitSeeder::class,
            AllocationSeeder::class,
            PrestationSeeder::class,
            ReclamationSeeder::class,
            FinanceSeeder::class,
       ]);
    }
}
