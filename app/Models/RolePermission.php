<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Pivot
{
    protected $table = 'role_permission';

    protected $fillable = [
        // Removed 'date_attribution'
        'created_by_user_id',
        'updated_by_user_id',
    ];

    protected $guarded = [
        'role_id',
        'permission_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        // Removed 'date_attribution'
        'role_id' => 'int', // Cast to integer
        'permission_id' => 'int', // Cast to integer
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
