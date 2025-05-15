<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mutualiste extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'numero_adherent',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'adresse',
        'telephone',
        'profession',
        'date_premiere_adhesion',
    ];

     protected $guarded = [
        'created_at',
        'updated_at',
        'created_by_user_id',
        'updated_by_user_id',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_premiere_adhesion' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function queryFilters(): array
    {
        return [
            'self' => function (Builder $query, $user) {
                $query->where('id', $user->id);
            },
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function fonction(): BelongsTo
    {
        return $this->belongsTo(FonctionMutualiste::class, 'fonction_mutualiste_id');
    }

}
