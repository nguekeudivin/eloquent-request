<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mutualiste;
use App\Models\User;
use App\Models\Reclamation;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReclamationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('messages')->delete();
        DB::table('conversation_participant')->delete();
        DB::table('conversations')->delete();
        DB::table('reclamations')->delete();

        $faker = \Faker\Factory::create('fr_FR');

        // 1. Sélectionner 5 mutualistes
        $mutualistes = Mutualiste::with('user')->inRandomOrder()->take(5)->get();

        // 2. Récupérer l’admin avec username "reclammation_service"
        $admin = User::where('username', 'reclammation_service')->firstOrFail();

        $statuts = ['SOUMISE', 'EN COURS', 'RESOLUE', 'FERMEE', 'ESCALADEE'];

        foreach ($mutualistes as $index => $mutualiste) {
            $user = $mutualiste->user;

            if (!$user) continue;

            // 3. Créer la réclamation
            $reclamation = Reclamation::create([
                'id' => Str::uuid(),
                'reference' => strtoupper(Str::random(10)),
                'mutualiste_id' => $mutualiste->id,
                'date_soumission' => now()->subDays(rand(1, 30)),
                'sujet' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'statut' => $statuts[$index % count($statuts)],
                'date_mise_a_jour_statut' => now(),
                'soumise_par_utilisateur_id' => $user->id,
                'assignee_a_admin_id' => $admin->id,
                'created_by_user_id' => $user->id,
                'updated_by_user_id' => $user->id,
            ]);

            // 4. Créer une conversation liée à la réclamation
            $conversation = Conversation::create([
                'id' => Str::uuid(),
                'sujet' => $reclamation->sujet,
                'date_creation' => now(),
                'statut' => 'fermé',
                'conversationable_id' => $reclamation->id,
                'conversationable_type' => Reclamation::class,
                'created_by_user_id' => $user->id,
                'updated_by_user_id' => $user->id,
            ]);

            // 5. Ajouter les participants
            DB::table('conversation_participant')->insert([
                [
                    'conversation_id' => $conversation->id,
                    'utilisateur_id' => $user->id,
                    'date_jointure' => now(),
                    'est_actif' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'conversation_id' => $conversation->id,
                    'utilisateur_id' => $admin->id,
                    'date_jointure' => now(),
                    'est_actif' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);

            // 6. Simuler un échange de messages
            $messages = [
                [$user->id, "Bonjour, je souhaite soumettre une réclamation concernant ma dernière prise en charge."],
                [$admin->id, "Bonjour, pouvez-vous préciser le problème rencontré ?"],
                [$user->id, "Oui, le montant remboursé ne correspond pas à ce que j’attendais."],
                [$admin->id, "Merci pour votre retour. Nous allons examiner la situation et revenir vers vous rapidement."],
                [$admin->id, "La situation est maintenant résolue. Merci de votre patience."],
                [$user->id, "Merci pour la prise en charge rapide."],
            ];

            foreach ($messages as $m) {
                Message::create([
                    'id' => Str::uuid(),
                    'conversation_id' => $conversation->id,
                    'utilisateur_id' => $m[0],
                    'date_envoi' => now(),
                    'contenu' => $m[1],
                    'est_lu' => true,
                ]);
            }
        }
    }
}
