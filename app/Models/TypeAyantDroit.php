<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Pour la relation vers AyantDroit
use App\Models\User; // Pour les relations d'audit
// Importer AyantDroit une fois défini : use App\Models\AyantDroit;


class TypeAyantDroit extends Model
{
    use HasFactory;


    protected $fillable = [
        'libelle',
        'description',
    ];

    protected $casts = [
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

    // Relation vers l'utilisateur qui a créé le type
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // Relation vers l'utilisateur qui a mis à jour le type
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function modalitesRemboursement(): HasMany
    {
        return $this->hasMany(ModaliteRemboursement::class, 'type_ayant_droit_id');
    }

}
