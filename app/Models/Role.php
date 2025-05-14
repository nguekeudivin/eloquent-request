<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Import BelongsToMany
use App\Models\UserRole; // Import UserRole pivot model
use App\Models\RolePermission; // Import RolePermission pivot model

class Role extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'code',
        'description',
    ];

     protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'created_by_user_id',
        'updated_by_user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    // Relation to users via user_role pivot table
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id')
                    ->using(UserRole::class) // Use the pivot model
                    ->withPivot('created_by_user_id', 'updated_by_user_id') // Load additional columns
                    ->withTimestamps(); // Manage created_at and updated_at on pivot
    }

    // Relation to permissions via role_permission pivot table
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id')
                    ->using(RolePermission::class) // Use the pivot model
                    ->withPivot('created_by_user_id', 'updated_by_user_id') // Load additional columns
                    ->withTimestamps(); // Manage created_at and updated_at on pivot
    }
}
