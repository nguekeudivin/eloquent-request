<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'email',
        'password',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $rels = [
        "posts",
        "admin",
        "roles"
    ];

    public static function queryFilters(): array
    {
        return [
            'me' => function (Builder $query, $user) {
                $query->where('id', $user->id);
            },
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function admin()
    {
        return $this->hasOne(Admin::class, 'id'); // Lier users.id à admins.id
    }


    // Define the relationship to roles via the user_role pivot table
    public function roles(): BelongsToMany
    {
        // role_id is integer, user_id is string (UUID)
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')
            ->using(UserRole::class)
            ->withTimestamps();
    }

    // Method to get all permissions through roles
    public function getPermissions()
    {
        // Load roles and their permissions if not already loaded to avoid N+1 issues
        if (! $this->relationLoaded('roles') || $this->roles->isEmpty() || ! $this->roles->every(fn ($role) => $role->relationLoaded('permissions'))) {
            $this->load('roles.permissions');
        }

        // Pluck permissions from all roles, flatten the collection of collections, and get unique permissions
        return $this->roles->pluck('permissions')->flatten()->unique('id')->pluck('name')->toArray(); // Use unique('id') to compare by permission ID
    }

    public function hasPermission(string $permissionName)
    {
        return in_array($permissionName, $this->getPermissions());
    }

}
