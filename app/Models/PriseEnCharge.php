<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Mutualiste;
use App\Models\AyantDroit;
use App\Models\Prestation;
use App\Models\Adhesion;
// Importer le modèle Document si vous liez des justificatifs
// use App\Models\Document;
use Illuminate\Support\Carbon;


class PriseEnCharge extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'prise_en_charges';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'reference',
        'date_soins_facture',
        'mutualiste_id',
        'ayant_droit_id',
        'prestation_id',
        'adhesion_id',
        'montant_facture',
        'montant_pris_en_charge',
        'date_soumission',
        'date_mise_a_jour_statut',
        'statut',
        'description',
        'soumise_par_utilisateur_id',
        'validee_par_admin_id',
    ];

    protected $casts = [
        'date_soins_facture' => 'date',
        'mutualiste_id' => 'string',
        'ayant_droit_id' => 'string',
        'prestation_id' => 'int',
        'adhesion_id' => 'string',
        'montant_facture' => 'decimal:2',
        'montant_pris_en_charge' => 'decimal:2',
        'date_soumission' => 'datetime',
        'date_mise_a_jour_statut' => 'datetime',
        'statut' => 'string',
        'soumise_par_utilisateur_id' => 'string',
        'validee_par_admin_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     protected $guarded = [
         'id',
         'created_by_user_id',
         'updated_by_user_id',
         'created_at',
         'updated_at',
     ];

    static $STATUTS = ['SOUMISE', 'EN COURS', 'VALIDEE', 'REMBOURSEE', 'REFUSEE', 'ANNULEE'];

    public function mutualiste(): BelongsTo
    {
        return $this->belongsTo(Mutualiste::class, 'mutualiste_id');
    }

    public function ayantDroit(): BelongsTo
    {
        return $this->belongsTo(AyantDroit::class, 'ayant_droit_id');
    }

    public function prestation(): BelongsTo
    {
        return $this->belongsTo(Prestation::class, 'prestation_id');
    }

    public function adhesion(): BelongsTo
    {
        return $this->belongsTo(Adhesion::class, 'adhesion_id');
    }

    public function soumiseParUtilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'soumise_par_utilisateur_id');
    }

    public function valideeParAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validee_par_admin_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    /**
     * Marque la demande comme "validée" et définit le montant pris en charge et l'admin.
     *
     * @param string $adminId L'ID de l'admin qui valide.
     * @param float $montantPrisEnCharge Le montant validé.
     * @return bool Succès de la sauvegarde.
     */
    public function valider(string $adminId, float $montantPrisEnCharge): bool
    {
        // Ne valider que si le statut est 'soumise' ou 'en cours'
        if (in_array($this->statut, ['SOUMISE', 'EN COURS'])) {
             $this->statut = 'VALIDEE';
             $this->montant_pris_en_charge = $montantPrisEnCharge;
             $this->validee_par_admin_id = $adminId;
             $this->date_mise_a_jour_statut = now();
             return $this->save();
        }
        return false;
    }

    /**
     * Marque la demande comme "refusée" et définit l'admin.
     *
     * @param string $adminId L'ID de l'admin qui refuse.
     * @param string|null $motif Le motif du refus (peut écraser la description initiale).
     * @return bool Succès de la sauvegarde.
     */
    public function refuser(string $adminId, ?string $motif = null): bool
    {
         // Ne refuser que si le statut n'est pas 'validée' ou 'remboursée' ou 'annulée'
        if (!in_array($this->statut, ['VALIDEE', 'REMBOURSEE', 'ANNULEE'])) {
             $this->statut = 'REFUSEE';
             $this->validee_par_admin_id = $adminId;
             $this->date_mise_a_jour_statut = now();
             if ($motif) {
                 $this->description = $motif; // Utiliser la description pour le motif de refus
             }
             return $this->save();
        }
        return false;
    }

    /**
     * Marque la demande comme "remboursée".
     *
     * @return bool Succès de la sauvegarde.
     */
    public function marquerRemboursee(): bool
    {
         // Ne marquer comme remboursée que si le statut est 'validée'
        if ($this->statut === 'VALIDEE') {
             $this->statut = 'REMBOURSEE';
             $this->date_mise_a_jour_statut = now();
             return $this->save();
        }
        return false;
    }

     /**
     * Marque la demande comme "annulée".
     *
     * @return bool Succès de la sauvegarde.
     */
     public function annuler(): bool
     {
          // Ne pas annuler si déjà validée, remboursée ou refusée
         if (!in_array($this->statut, ['VALIDEE', 'REMBOURSEE', 'REFUSEE'])) {
             $this->statut = 'ANNULEE';
             $this->date_mise_a_jour_statut = now();
             return $this->save();
         }
         return false;
     }

    /**
     * Associe un document justificatif à la demande.
     * Nécessite une relation ou une table pivot pour les documents.
     *
     * @param string $documentId L'ID du document à lier.
     * @return bool Succès de l'opération.
     */
    // public function associerJustificatif(string $documentId): bool
    // {
        // Implémenter la logique de liaison de document ici
        // Ex: $this->documents()->attach($documentId);
        // return true; // ou false en cas d'échec
    // }


}
