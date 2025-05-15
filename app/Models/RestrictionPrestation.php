<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Mutualiste;
use App\Models\TypePrestation;
use Illuminate\Support\Carbon;


class RestrictionPrestation extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'mutualiste_id',
        'type_prestation_id',
        'date_expiration',
    ];

    protected $casts = [
        'mutualiste_id' => 'string',
        'type_prestation_id' => 'int',
        'date_expiration' => 'date',
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

    public function mutualiste(): BelongsTo
    {
        return $this->belongsTo(Mutualiste::class, 'mutualiste_id');
    }

    public function typePrestation(): BelongsTo
    {
        return $this->belongsTo(TypePrestation::class, 'type_prestation_id');
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
