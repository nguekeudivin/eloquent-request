<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Removed: use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Import BelongsToMany
use App\Models\RolePermission; // Import RolePermission pivot model


class Permission extends Model
{
    use HasFactory; // Removed HasUuids

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $keyType = 'int'; // Key type is integer
    public $incrementing = true; // ID is auto-incrementing

    protected $fillable = [
        'name', // Column name is now 'name'
        'resource', // New 'resource' column
        'description',
    ];

     protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        // Removed audit fields from guarded as they are not in the table
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Removed createdBy/updatedBy relations as audit fields are not in the table

    // Relation to roles via role_permission pivot table
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id')
                    ->using(RolePermission::class) // Use the pivot model
                    ->withPivot('created_by_user_id', 'updated_by_user_id') // Load additional columns
                    ->withTimestamps(); // Manage created_at and updated_at on pivot
    }

     /**
     * Define query filters for listing permissions.
     * Example filters (implement logic in closures)
     *
     * @return array<string, \Closure>
     */
    public static function queryFilters(): array
    {
        return [
            // Example filter: only show permissions for a specific resource
            'resource' => function (\Illuminate\Database\Eloquent\Builder $query, string $resourceName) {
                $query->where('resource', $resourceName);
            },
            // Example filter: only show permissions with a specific name pattern
            'name_pattern' => function (\Illuminate\Database\Eloquent\Builder $query, string $pattern) {
                 $query->where('name', 'like', $pattern);
            },
        ];
    }
}
