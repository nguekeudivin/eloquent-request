<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\TypePrestation;
use App\Models\TypeAyantDroit;


class ModaliteRemboursement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_prestation_id',
        'type_ayant_droit_id',
        'taux_hopital_public',
        'taux_hopital_prive',
    ];

    protected $casts = [
        'type_prestation_id' => 'int',
        'type_ayant_droit_id' => 'int',
        'taux_hopital_public' => 'decimal:2',
        'taux_hopital_prive' => 'decimal:2',
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

    public function type_prestation(): BelongsTo
    {
        return $this->belongsTo(TypePrestation::class, 'type_prestation_id');
    }

    public function type_ayant_droit(): BelongsTo
    {
        return $this->belongsTo(TypeAyantDroit::class, 'type_ayant_droit_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }


}
