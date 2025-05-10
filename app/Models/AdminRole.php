<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminRole extends Pivot
{
    protected $table = 'admin_role';

    protected $fillable = [
        'date_attribution',
    ];

    protected $guarded = [
        'admin_id',
        'role_id',
        'created_at',
        'updated_at',
        'created_by_user_id',
        'updated_by_user_id',
    ];

    protected $casts = [
        'date_attribution' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function admin(): BelongsTo // Nom de la relation (et du modèle) changé ici
    {
        return $this->belongsTo(Admin::class, 'admin_id'); // Référence au modèle Admin
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
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
