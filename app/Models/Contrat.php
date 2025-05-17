<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Trait pour les UUID
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contrat extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nom',
        'description',
        'date_debut_validite',
        'date_fin_validite',
        'montant_cotisation_base',
        'montant_adhesion',
        'periode_cotisation',
        'est_actif',
    ];

    protected $casts = [
        'date_debut_validite' => 'date',
        'date_fin_validite' => 'date',
        'montant_cotisation_base' => 'decimal:2',
        'periode_cotisation' => 'string',
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


    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function groupesMutualistes(): BelongsToMany
    {

        return $this->belongsToMany(GroupeMutualiste::class, 'groupe_contrat', 'contrat_id', 'groupe_id')
                    ->using(GroupeContrat::class)
                    ->withPivot('created_by_user_id', 'updated_by_user_id')
                    ->withTimestamps();
    }


}
