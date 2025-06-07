<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\RolePermission;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
    ];

    protected $guarded = [
       'created_at',
       'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id')
                    ->using(RolePermission::class)
                    ->withTimestamps();
    }

}
