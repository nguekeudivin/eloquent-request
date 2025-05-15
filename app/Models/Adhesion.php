<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Mutualiste;
use App\Models\Contrat;
use App\Models\Cotisation;
use Illuminate\Support\Carbon;


class Adhesion extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'adhesions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'mutualiste_id',
        'contrat_id',
        'date_debut',
        'date_fin',
        'statut',
        'reference_externe',
        'motif_resiliation',
    ];

    protected $casts = [
        'mutualiste_id' => 'string',
        'contrat_id' => 'string',
        'date_debut' => 'date',
        'date_fin' => 'date',
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

    public function mutualiste(): BelongsTo
    {
        return $this->belongsTo(Mutualiste::class, 'mutualiste_id');
    }

    public function contrat(): BelongsTo
    {
        return $this->belongsTo(Contrat::class, 'contrat_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function cotisations(): HasMany
    {
        return $this->hasMany(Cotisation::class, 'adhesion_id');
    }

    /**
     * Change le statut à "résilié" et définit la date de fin et le motif.
     *
     * @param Carbon|string|null $dateFin La date effective de fin de l'adhésion. Null pour la date du jour.
     * @param string|null $motif Le motif de la résiliation.
     * @return bool Succès de la sauvegarde.
     */
    public function resilier(Carbon|string|null $dateFin = null, ?string $motif = null): bool
    {
        $this->statut = 'résilié';
        $this->date_fin = $dateFin ? Carbon::parse($dateFin) : now();
        $this->motif_resiliation = $motif;
        return $this->save();
    }

    /**
     * Change le statut à "suspendu".
     *
     * @return bool Succès de la sauvegarde.
     */
    public function suspendre(): bool
    {
        $this->statut = 'suspendu';
        return $this->save();
    }

    /**
     * Change le statut à "actif".
     *
     * @return bool Succès de la sauvegarde.
     */
    public function reactiver(): bool
    {
        $this->statut = 'actif';
        return $this->save();
    }

     /**
     * Change le statut à "inactif".
     * @return bool Succès de la sauvegarde.
     */
     public function desactiver(): bool
     {
         $this->statut = 'inactif';
         $this->date_fin = null;
         $this->motif_resiliation = null;
         return $this->save();
     }
}
