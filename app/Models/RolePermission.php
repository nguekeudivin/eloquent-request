<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Pivot
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'date_attribution',
    ];

    protected $guarded = [
        'role_id',
        'permission_id',
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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
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
