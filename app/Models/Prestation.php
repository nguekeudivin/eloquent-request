<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\TypePrestation;


class Prestation extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom',
        'description',
        'code_interne',
        'montant_reference',
        'est_active',
        'type_prestation_id',
    ];

    protected $casts = [
        'montant_reference' => 'decimal:2',
        'est_active' => 'boolean',
        'type_prestation_id' => 'int',
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

    public function type(): BelongsTo
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

    /**
     * Change le statut 'est_active' à false.
     *
     * @return bool Succès de la sauvegarde.
     */
    public function desactiver(): bool
    {
        $this->est_active = false;
        return $this->save();
    }

    /**
     * Change le statut 'est_active' à true.
     *
     * @return bool Succès de la sauvegarde.
     */
    public function activer(): bool
    {
        $this->est_active = true;
        return $this->save();
    }



}
