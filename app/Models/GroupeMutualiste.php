<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;


class GroupeMutualiste extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function contrats(): BelongsToMany
    {
        return $this->belongsToMany(Contrat::class, 'groupe_contrat', 'groupe_id', 'contrat_id')
                    ->using(GroupeContrat::class)
                    ->withPivot('created_by_user_id', 'updated_by_user_id')
                    ->withTimestamps();
    }

    public function typeAllocations(): BelongsToMany
    {
        return $this->belongsToMany(TypeAllocation::class, 'groupe_allocation', 'groupe_id', 'type_allocation_id')
                    ->using(GroupeAllocation::class)
                    ->withPivot('montant', 'created_by_user_id', 'updated_by_user_id')
                    ->withTimestamps();
    }

}
