<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->delete();

        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('Impossible de seeder les notifications : Aucun utilisateur trouvé. Lancez le UserSeeder ou assurez-vous que des utilisateurs existent.');
            return;
        }

        $notificationsToSeed = [];

        foreach ($users as $user) {
            // Welcome Notification
            $notificationsToSeed[] = [
                'user_id' => $user->id,
                'type_notification' => 'bienvenue',
                'titre' => 'Bienvenue sur notre plateforme !',
                'contenu' => 'Nous sommes ravis de vous compter parmi nous. Explorez les fonctionnalités et découvrez tout ce que nous offrons.',
                'est_lue' => false,
                'date_lecture' => null,
                'lien_cible' => '/dashboard',
                'created_at' => now(), // Manual timestamps for bulk insert
                'updated_at' => now(),
            ];

            // Profile Invitation Notification
            $notificationsToSeed[] = [
                'user_id' => $user->id,
                'type_notification' => 'invitation_profil',
                'titre' => 'Mettez à jour votre profil !',
                'contenu' => 'Votre profil est une partie essentielle de votre expérience. Prenez un moment pour le compléter ou le mettre à jour.',
                'est_lue' => false,
                'date_lecture' => null,
                'lien_cible' => '/profile',
                'created_at' => now(), // Manual timestamps for bulk insert
                'updated_at' => now(),
            ];
        }

        // Insert all notifications at once for better performance
        if (!empty($notificationsToSeed)) {
             Notification::insert($notificationsToSeed);
             $this->command->info('Notifications de bienvenue et d\'invitation au profil seedées pour ' . $users->count() . ' utilisateurs.');
        } else {
             $this->command->info('Aucune notification à seeder car aucun utilisateur n\'a été trouvé.');
        }
    }
}
