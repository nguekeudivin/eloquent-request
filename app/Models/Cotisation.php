<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Adhesion;
use Illuminate\Support\Carbon;

class Cotisation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cotisations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'adhesion_id',
        'periode_concerne',
        'montant_prevu',
        'montant_paye',
        'date_limite_paiement',
        'date_paiement_effective',
        'statut',
        'reference_externe',
    ];

    protected $casts = [
        'adhesion_id' => 'string',
        'montant_prevu' => 'decimal:2',
        'montant_paye' => 'decimal:2',
        'date_limite_paiement' => 'date',
        'date_paiement_effective' => 'date',
        'statut' => 'string',
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

    public function adhesion(): BelongsTo
    {
        return $this->belongsTo(Adhesion::class, 'adhesion_id');
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
     * Applique un montant payé à la cotisation et met à jour le statut si nécessaire.
     *
     * @param float $montant Le montant payé à appliquer.
     * @return bool Succès de la sauvegarde.
     */
    public function appliquerPaiement(float $montant): bool
    {
        if ($montant <= 0) {
            return false; // Ne pas appliquer de montant négatif ou nul
        }

        $this->montant_paye += $montant;

        // Mettre à jour le statut basé sur le montant payé vs prévu
        if ($this->montant_paye >= $this->montant_prevu) {
            $this->statut = 'payée';
            // Définir la date de paiement effective si elle n'est pas déjà définie
            if (is_null($this->date_paiement_effective)) {
                 $this->date_paiement_effective = now();
            }
        } elseif ($this->montant_paye > 0) {
            $this->statut = 'partielle';
             $this->date_paiement_effective = null; // Effacer si elle était définie
        } else {
             // Si montant_paye redevient 0 (ce qui ne devrait pas arriver avec cette logique),
             // ou si elle était partielle et devient 0
             $this->statut = ($this->date_limite_paiement < now() && $this->statut !== 'annulée') ? 'en retard' : 'due';
             $this->date_paiement_effective = null;
        }

        return $this->save();
    }

    /**
     * Marque la cotisation comme "payée" et définit la date de paiement effective.
     * Utile si le paiement est géré en dehors de appliquerPaiement ou pour forcer le statut.
     *
     * @param Carbon|string|null $datePaiement La date de paiement effective. Null pour la date du jour.
     * @return bool Succès de la sauvegarde.
     */
    public function marquerPayee(Carbon|string|null $datePaiement = null): bool
    {
        $this->statut = 'payée';
        $this->date_paiement_effective = $datePaiement ? Carbon::parse($datePaiement) : now();
        // Optionnel : s'assurer que montant_paye == montant_prevu si on marque comme payée
        // $this->montant_paye = $this->montant_prevu;
        return $this->save();
    }

    /**
     * Marque la cotisation comme "en retard".
     *
     * @return bool Succès de la sauvegarde.
     */
    public function marquerEnRetard(): bool
    {
        // Ne marquer en retard que si le statut n'est pas déjà payée ou annulée
        if (!in_array($this->statut, ['payée', 'annulée'])) {
             $this->statut = 'en retard';
             return $this->save();
        }
        return false; // Statut non modifié
    }

    /**
     * Marque la cotisation comme "annulée".
     *
     * @return bool Succès de la sauvegarde.
     */
    public function annuler(): bool
    {
        // Optionnel : logique pour gérer les montants payés si la cotisation est annulée après paiement partiel
        // $this->montant_paye = 0; // Remboursement ou autre logique
        $this->statut = 'annulée';
        $this->date_paiement_effective = null; // Effacer la date de paiement
        return $this->save();
    }

}
