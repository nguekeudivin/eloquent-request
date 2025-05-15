<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importer HasMany
use App\Models\User;
use App\Models\ModaliteRemboursement; // Importer ModaliteRemboursement


class TypePrestation extends Model
{
    use HasFactory;


    protected $fillable = [
        'libelle',
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

    // Relation HasMany vers les modalités de remboursement associées à ce type de prestation
    public function modalitesRemboursement(): HasMany
    {
        return $this->hasMany(ModaliteRemboursement::class, 'type_prestation_id');
    }


}
