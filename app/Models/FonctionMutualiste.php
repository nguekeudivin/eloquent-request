<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\GroupeMutualiste;

class FonctionMutualiste extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'groupe_mutualiste_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'groupe_mutualiste_id' => 'int', // Caster l'ID groupe en int
    ];

     protected $guarded = [
         'id',
         'created_by_user_id',
         'updated_by_user_id',
         'created_at',
         'updated_at',
     ];

    // Relation vers le groupe mutualiste auquel cette fonction est rattachée
    public function groupe_mutualiste(): BelongsTo
    {
        return $this->belongsTo(GroupeMutualiste::class, 'groupe_mutualiste_id');
    }

    // Relation vers l'utilisateur qui a créé la fonction
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // Relation vers l'utilisateur qui a mis à jour la fonction pour la dernière fois
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

}
