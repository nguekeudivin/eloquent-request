<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;


class TypeAllocation extends Model
{
    use HasFactory;


    protected $fillable = [
        'libelle',
        'montant_standard',
        'montant_max',
        'montant_min',
    ];

    protected $casts = [
        'montant_standard' => 'decimal:2',
        'montant_max' => 'decimal:2',
        'montant_min' => 'decimal:2',
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function groupesMutualistes(): BelongsToMany
    {
        return $this->belongsToMany(GroupeMutualiste::class, 'groupe_allocation', 'type_allocation_id', 'groupe_id')
                    ->using(GroupeAllocation::class)
                    ->withPivot('montant', 'created_by_user_id', 'updated_by_user_id')
                    ->withTimestamps();
    }
}
