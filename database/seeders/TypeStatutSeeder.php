<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeStatut;
use Illuminate\Support\Carbon;

class TypeStatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusTypes = [
            // Statuts pour les utilisateurs
            [
                'code_interne' => 'USER_ACTIF',
                'libelle' => 'Compte Actif',
                'description' => 'Le compte utilisateur est actif et pleinement fonctionnel.',
                'contexte' => 'user',
                'couleur_hex' => '#28a745',
                'ordre_affichage' => 10,
            ],
            [
                'code_interne' => 'USER_INACTIF',
                'libelle' => 'Compte Inactif',
                'description' => 'Le compte utilisateur est temporairement désactivé.',
                'contexte' => 'user',
                'couleur_hex' => '#ffc107',
                'ordre_affichage' => 20,
            ],
             [
                'code_interne' => 'USER_BLOQUE',
                'libelle' => 'Compte Bloqué',
                'description' => 'Le compte utilisateur est bloqué, nécessitant une intervention manuelle.',
                'contexte' => 'user',
                'couleur_hex' => '#dc3545',
                'ordre_affichage' => 30,
            ],

            // Statuts pour les adhésions
            [
                'code_interne' => 'ADHESION_ACTIVE',
                'libelle' => 'Adhésion Active',
                'description' => 'L\'adhésion est courante et valide.',
                'contexte' => 'adhesion',
                'couleur_hex' => '#28a745',
                'ordre_affichage' => 10,
            ],
            [
                'code_interne' => 'ADHESION_RESILIEE',
                'libelle' => 'Adhésion Résiliée',
                'description' => 'L\'adhésion a été résiliée par le mutualiste ou la mutuelle.',
                'contexte' => 'adhesion',
                'couleur_hex' => '#6c757d',
                'ordre_affichage' => 40,
            ],
             [
                'code_interne' => 'ADHESION_EXPIREE',
                'libelle' => 'Adhésion Expirée',
                'description' => 'La période de l\'adhésion est arrivée à terme.',
                'contexte' => 'adhesion',
                'couleur_hex' => '#dc3545',
                'ordre_affichage' => 50,
            ],
             [
                'code_interne' => 'ADHESION_SUSPENDUE',
                'libelle' => 'Adhésion Suspendue',
                'description' => 'L\'adhésion est temporairement suspendue (ex: non-paiement).',
                'contexte' => 'adhesion',
                'couleur_hex' => '#ffc107',
                'ordre_affichage' => 30,
            ],

            // Statuts pour les cotisations
             [
                'code_interne' => 'COTISATION_DUE',
                'libelle' => 'Cotisation Due',
                'description' => 'L\'échéance de cotisation est due.',
                'contexte' => 'cotisation',
                'couleur_hex' => '#dc3545',
                'ordre_affichage' => 30,
            ],
             [
                'code_interne' => 'COTISATION_PAYEE',
                'libelle' => 'Cotisation Payée',
                'description' => 'L\'échéance de cotisation a été intégralement payée.',
                'contexte' => 'cotisation',
                'couleur_hex' => '#28a745',
                'ordre_affichage' => 10,
            ],
             [
                'code_interne' => 'COTISATION_PARTIELLE',
                'libelle' => 'Cotisation Partielle',
                'description' => 'L\'échéance de cotisation a été partiellement payée.',
                'contexte' => 'cotisation',
                'couleur_hex' => '#ffc107',
                'ordre_affichage' => 20,
            ],
             [
                'code_interne' => 'COTISATION_EN_RETARD',
                'libelle' => 'Cotisation En Retard',
                'description' => 'L\'échéance de cotisation est en retard de paiement.',
                'contexte' => 'cotisation',
                'couleur_hex' => '#dc3545',
                'ordre_affichage' => 40,
            ],

            // Statuts pour les prêts
             [
                'code_interne' => 'PRET_EN_COURS',
                'libelle' => 'Prêt En Cours',
                'description' => 'Le remboursement du prêt est en cours.',
                'contexte' => 'pret',
                'couleur_hex' => '#007bff',
                'ordre_affichage' => 10,
            ],
             [
                'code_interne' => 'PRET_SOLDE',
                'libelle' => 'Prêt Soldé',
                'description' => 'Le prêt a été intégralement remboursé.',
                'contexte' => 'pret',
                'couleur_hex' => '#28a745',
                'ordre_affichage' => 20,
            ],
             [
                'code_interne' => 'PRET_EN_RETARD',
                'libelle' => 'Prêt En Retard',
                'description' => 'Le remboursement du prêt est en retard.',
                'contexte' => 'pret',
                'couleur_hex' => '#dc3545',
                'ordre_affichage' => 30,
            ],

            // Statuts pour les prises en charge
             [
                'code_interne' => 'PEC_SOUMISE',
                'libelle' => 'Soumise',
                'description' => 'Demande de prise en charge soumise, en attente de traitement.',
                'contexte' => 'prise_en_charge',
                'couleur_hex' => '#007bff',
                'ordre_affichage' => 10,
            ],
             [
                'code_interne' => 'PEC_EN_COURS',
                'libelle' => 'En Cours',
                'description' => 'Demande de prise en charge en cours d\'évaluation.',
                'contexte' => 'prise_en_charge',
                'couleur_hex' => '#ffc107',
                'ordre_affichage' => 20,
            ],
             [
                'code_interne' => 'PEC_VALIDEE',
                'libelle' => 'Validée',
                'description' => 'Demande de prise en charge validée, prête au remboursement/paiement.',
                'contexte' => 'prise_en_charge',
                'couleur_hex' => '#28a745',
                'ordre_affichage' => 30,
            ],
             [
                'code_interne' => 'PEC_REMBOURSEE',
                'libelle' => 'Remboursée/Payée',
                'description' => 'La prise en charge a été liquidée.',
                'contexte' => 'prise_en_charge',
                'couleur_hex' => '#20c997',
                'ordre_affichage' => 40,
            ],
            [
                'code_interne' => 'PEC_REFUSEE',
                'libelle' => 'Refusée',
                'description' => 'Demande de prise en charge refusée.',
                'contexte' => 'prise_en_charge',
                'couleur_hex' => '#dc3545',
                'ordre_affichage' => 50,
            ],

             // Statuts pour les réclamations
             [
                'code_interne' => 'RECLAMATION_SOUMISE',
                'libelle' => 'Soumise',
                'description' => 'Réclamation enregistrée, en attente d\'assignation.',
                'contexte' => 'reclamation',
                'couleur_hex' => '#007bff',
                'ordre_affichage' => 10,
            ],
            [
                'code_interne' => 'RECLAMATION_EN_COURS',
                'libelle' => 'En Cours',
                'description' => 'Réclamation en cours de traitement par l\'administration.',
                'contexte' => 'reclamation',
                'couleur_hex' => '#ffc107',
                'ordre_affichage' => 20,
            ],
             [
                'code_interne' => 'RECLAMATION_RESOLUE',
                'libelle' => 'Résolue',
                'description' => 'Réclamation dont une solution a été apportée.',
                'contexte' => 'reclamation',
                'couleur_hex' => '#28a745',
                'ordre_affichage' => 30,
            ],
             [
                'code_interne' => 'RECLAMATION_FERMEE',
                'libelle' => 'Fermée',
                'description' => 'Réclamation clôturée.',
                'contexte' => 'reclamation',
                'couleur_hex' => '#6c757d',
                'ordre_affichage' => 40,
            ],
        ];

        foreach ($statusTypes as $type) {
            $existingStatus = TypeStatut::where('code_interne', $type['code_interne'])
                                       ->where('contexte', $type['contexte'])
                                       ->first();

            if (!$existingStatus) {
                TypeStatut::create([
                    'code_interne' => $type['code_interne'],
                    'libelle' => $type['libelle'],
                    'description' => $type['description'],
                    'contexte' => $type['contexte'],
                    'couleur_hex' => $type['couleur_hex'],
                    'ordre_affichage' => $type['ordre_affichage'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
