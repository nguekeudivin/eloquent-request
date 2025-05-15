<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroupeMutualiste;
use App\Models\TypeAllocation;
use App\Models\User; // Pour les champs d'audit
use Illuminate\Support\Facades\DB;

class GroupeAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: Truncate the pivot table before seeding
        DB::table('groupe_allocation')->truncate();

        // Récupérer des exemples de Groupes, Types d'Allocation et un utilisateur d'audit
        // Assurez-vous que ces seeders ont été exécutés.
        $groupeCA = GroupeMutualiste::where('nom', 'Conseil d\'Administration')->first();
        $groupeComite = GroupeMutualiste::where('nom', 'Comité de Contrôle')->first();

        $typeDecesMutualiste = TypeAllocation::where('libelle', 'Décès Mutualiste')->first();
        $typeMariage = TypeAllocation::where('libelle', 'Allocation Mariage')->first();
        $typeNaissance = TypeAllocation::where('libelle', 'Allocation Naissance')->first();

        $adminUser = User::where('username', 'admin')->first(); // Utilisateur pour l'audit

        if (!$groupeCA || !$groupeComite || !$typeDecesMutualiste || !$typeMariage || !$typeNaissance || !$adminUser) {
             $this->command->warn('Impossible de seeder les liaisons GroupeAllocation : Assurez-vous que les GroupesMutualistes, TypesAllocation et Users nécessaires existent.');
             return;
        }

        // Lier les entités via la relation Many-to-Many en spécifiant le montant et les champs d'audit
        // Utilise la méthode attach() sur la relation BelongsToMany

        // Exemple 1: Le groupe CA reçoit l'allocation Décès Mutualiste avec un montant spécifique
        $groupeCA->typeAllocations()->attach($typeDecesMutualiste->id, [
            'montant' => 600000.00, // Montant spécifique pour ce groupe/type
            'created_by_user_id' => $adminUser->id,
            'updated_by_user_id' => $adminUser->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         $this->command->info("Groupe '{$groupeCA->nom}' lié à TypeAllocation '{$typeDecesMutualiste->libelle}' avec montant 600000.00.");


        // Exemple 2: Le groupe Comité reçoit l'allocation Mariage avec un autre montant
        $groupeComite->typeAllocations()->attach($typeMariage->id, [
            'montant' => 180000.00,
            'created_by_user_id' => $adminUser->id,
            'updated_by_user_id' => $adminUser->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         $this->command->info("Groupe '{$groupeComite->nom}' lié à TypeAllocation '{$typeMariage->libelle}' avec montant 180000.00.");


        // Exemple 3: Le groupe CA reçoit aussi l'allocation Naissance
        $groupeCA->typeAllocations()->attach($typeNaissance->id, [
            'montant' => 120000.00,
            'created_by_user_id' => $adminUser->id,
            'updated_by_user_id' => $adminUser->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         $this->command->info("Groupe '{$groupeCA->nom}' lié à TypeAllocation '{$typeNaissance->libelle}' avec montant 120000.00.");


        $this->command->info('Seeder GroupeAllocation terminé.');
    }
}
