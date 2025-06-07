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


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')
            ->using(UserRole::class)
            ->withTimestamps();
    }

    public function getPermissions()
    {
        if (! $this->relationLoaded('roles') || $this->roles->isEmpty() || ! $this->roles->every(fn ($role) => $role->relationLoaded('permissions'))) {
            $this->load('roles.permissions');
        }
        return $this->roles->pluck('permissions')->flatten()->unique('id')->pluck('name')->toArray(); // Use unique('id') to compare by permission ID
    }

    public function hasPermission(string $permissionName)
    {
        return in_array($permissionName, $this->getPermissions());
    }

}
