<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User; // Pour les relations d'audit
use App\Models\GroupeMutualiste; // Pour la relation BelongsTo
use App\Models\Contrat; // Pour la relation BelongsTo


class GroupeContrat extends Pivot
{
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'groupe_id' => 'int',
        'contrat_id' => 'string',
    ];

    protected $fillable = [
        'groupe_id',
        'contrat_id',
    ];

    protected $guarded = [
        'created_by_user_id',
        'updated_by_user_id',
        'created_at',
        'updated_at',
    ];


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function groupe(): BelongsTo
    {
         return $this->belongsTo(GroupeMutualiste::class, 'groupe_id');
    }

    public function contrat(): BelongsTo
    {
         return $this->belongsTo(Contrat::class, 'contrat_id');
    }
}
