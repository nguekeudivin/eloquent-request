<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\GroupeMutualiste;
use App\Models\TypeAllocation;


class GroupeAllocation extends Pivot
{
    protected $table = 'groupe_allocation';

    protected $casts = [
        'groupe_id' => 'int',
        'type_allocation_id' => 'int',
        'montant' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     protected $guarded = [
        'groupe_id',
        'type_allocation_id',
        'montant',
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

      public function typeAllocation(): BelongsTo
     {
         return $this->belongsTo(TypeAllocation::class, 'type_allocation_id');
     }
}
