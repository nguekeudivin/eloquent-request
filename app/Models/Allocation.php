<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Mutualiste;
use App\Models\TypeAllocation;
use Illuminate\Support\Carbon;


class Allocation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'allocations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'mutualiste_id',
        'type_allocation_id',
        'date',
        'montant',
        'motif',
        'statut',
        'verifiee_par_admin_id',
        'versee_par_admin_id',
    ];

    protected $casts = [
        'mutualiste_id' => 'string',
        'type_allocation_id' => 'int',
        'date' => 'date',
        'montant' => 'decimal:2',
        'statut' => 'string',
        'verifiee_par_admin_id' => 'string',
        'versee_par_admin_id' => 'string',
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

    public function mutualiste(): BelongsTo
    {
        return $this->belongsTo(Mutualiste::class, 'mutualiste_id');
    }

    public function typeAllocation(): BelongsTo
    {
        return $this->belongsTo(TypeAllocation::class, 'type_allocation_id');
    }

    public function verifieeParAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifiee_par_admin_id');
    }

    public function verseeParAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'versee_par_admin_id');
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
     * Marque l'allocation comme "versée".
     *
     * @param string|null $adminId L'ID de l'admin qui enregistre le versement.
     * @return bool Succès de la sauvegarde.
     */
    public function marquerVersee(?string $adminId = null): bool
    {
        // Ne marquer comme versée que si le statut est 'accordée' ou 'versée' (pour les mises à jour)
        if (in_array($this->statut, ['accordée', 'versée'])) {
             $this->statut = 'versée';
             // Définir l'admin qui a enregistré le versement si fourni
             if ($adminId) {
                 $this->versee_par_admin_id = $adminId;
             }
             return $this->save();
        }
        return false; // Statut non modifié
    }

    /**
     * Marque l'allocation comme "refusée".
     *
     * @param string|null $motif Le motif du refus (peut écraser le motif initial).
     * @return bool Succès de la sauvegarde.
     */
    public function refuser(?string $motif = null): bool
    {
         // Ne refuser que si le statut n'est pas déjà 'versée' ou 'annulée'
        if (!in_array($this->statut, ['versée', 'annulée'])) {
             $this->statut = 'refusée';
             // Optionnel : mettre à jour le motif avec le motif du refus
             if ($motif) {
                 $this->motif = $motif;
             }
             return $this->save();
        }
        return false; // Statut non modifié
    }

     /**
     * Marque l'allocation comme "annulée".
     *
     * @return bool Succès de la sauvegarde.
     */
     public function annuler(): bool
     {
          // Ne pas annuler si déjà versée ou refusée
         if (!in_array($this->statut, ['versée', 'refusée'])) {
             $this->statut = 'annulée';
             // Optionnel : Logique pour défaire les opérations si nécessaire
             return $this->save();
         }
         return false; // Statut non modifié
     }



}
