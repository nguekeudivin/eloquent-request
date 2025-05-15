<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\PriseEnCharge;
use App\Models\ModaliteRemboursement; // Import the ModaliteRemboursement model
use Illuminate\Support\Carbon;


class Remboursement extends Model
{
    use HasFactory, HasUuids;


    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'prise_en_charge_id',
        'modalite_remboursement_id',
        'date_paiement',
        'montant_paye',
        'mode_paiement',
        'reference_transaction',
        'paye_par_admin_id',
    ];

    protected $casts = [
        'prise_en_charge_id' => 'string',
        'modalite_remboursement_id' => 'int',
        'date_paiement' => 'date',
        'montant_paye' => 'decimal:2',
        'mode_paiement' => 'string',
        'reference_transaction' => 'string',
        'paye_par_admin_id' => 'string',
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

    public function priseEnCharge(): BelongsTo
    {
        return $this->belongsTo(PriseEnCharge::class, 'prise_en_charge_id');
    }

    public function modaliteRemboursement(): BelongsTo
    {
        return $this->belongsTo(ModaliteRemboursement::class, 'modalite_remboursement_id');
    }

    public function payeParAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paye_par_admin_id');
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
     * Déclenche une notification ou un message pour informer le mutualiste du paiement.
     * Cette méthode nécessite l'implémentation d'un système de notification.
     *
     * @return bool Succès de l'opération.
     */
    // public function notifierMutualiste(): bool
    // {
        // Logique d'envoi de notification ici
        // Ex: Notification::send($this->priseEnCharge->mutualiste->user, new RemboursementEffectue($this));
        // return true; // ou false en cas d'échec
    // }

}
