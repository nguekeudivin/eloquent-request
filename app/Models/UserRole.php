<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Pivot
{
    protected $table = 'user_role';

    protected $fillable = [
        'user_id',
        'role_id',
        'created_by_user_id',
        'updated_by_user_id',
    ];

    protected $guarded = [
        'user_id',
        'role_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        // Removed 'date_attribution'
        'user_id' => 'string', // Remains string (UUID)
        'role_id' => 'int', // Cast to integer
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
