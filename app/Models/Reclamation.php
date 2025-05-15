<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Mutualiste;
use Illuminate\Support\Carbon;


class Reclamation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'reclamations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'reference',
        'mutualiste_id',
        'date_soumission',
        'sujet',
        'description',
        'statut',
        'date_mise_a_jour_statut',
        'soumise_par_utilisateur_id',
        'assignee_a_admin_id',
    ];

    protected $casts = [
        'date_soumission' => 'datetime',
        'date_mise_a_jour_statut' => 'datetime',
        // Utiliser les statuts en majuscules ici
        'statut' => 'string', // Le type reste string pour l'ENUM
        'mutualiste_id' => 'string',
        'soumise_par_utilisateur_id' => 'string',
        'assignee_a_admin_id' => 'string',
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

    public function soumiseParUtilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'soumise_par_utilisateur_id');
    }

    public function assigneeAAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_a_admin_id');
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
     * Assigne un admin à la réclamation.
     *
     * @param string|null $adminId L'ID de l'admin à assigner (null pour désassigner).
     * @return bool Succès de la sauvegarde.
     */
    public function assignerA(?string $adminId = null): bool
    {
        $this->assignee_a_admin_id = $adminId;
        return $this->save();
    }

    /**
     * Change le statut de la réclamation.
     *
     * @param string $nouveauStatut Le nouveau statut (en majuscules).
     * @return bool Succès de la sauvegarde.
     */
    public function changerStatut(string $nouveauStatut): bool
    {
        // Valider que le nouveau statut est valide (en majuscules)
        $validStatuses = ['SOUMISE', 'EN COURS', 'RESOLUE', 'FERMEE', 'ESCALADEE'];
        if (in_array($nouveauStatut, $validStatuses)) {
             $this->statut = $nouveauStatut;
             $this->date_mise_a_jour_statut = now();
             return $this->save();
        }
        return false;
    }

    /**
     * Change le statut à "FERMEE" et enregistre la résolution.
     *
     * @param string|null $resolution Description de la résolution.
     * @return bool Succès de la sauvegarde.
     */
    public function cloturer(?string $resolution = null): bool
    {
        // Ne fermer que si le statut est 'RESOLUE' ou 'EN COURS' (selon règles métier)
        if (in_array($this->statut, ['RESOLUE', 'EN COURS'])) {
             $this->statut = 'FERMEE';
             $this->date_mise_a_jour_statut = now();
             return $this->save();
        }
        return false;
    }


}
