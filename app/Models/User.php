<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'username',
        'email',
        'password',
        'statut_id',
        'last_connexion',
    ];

    // LECTURE

    // user:list

    // post:list:owner
    // post:list:public
    // post:list:published

    // user.*
    // user.username
    // user.email
    // user.password
    // user.statut_id
    // user.last_connexion

    // user.posts
    // post.*
    // post.title
    // post.slug
    // post.body

    // user->posts->author->[name, email]

    // user.posts - user.*
    // post.author - post.*
    // author.name  - author.*
    // author.email
    // author.*

    // user.posts.authorized
    // user.posts.public

    // CREATE/UPDATE/DELETE

    // user:create - autorise a create une instance
    // user:create:username
    // user:create:password
    // ...
    // user:create:*

    // user:update
    // user:update:username
    // user:update:password

    // user:delete

    // PERMISSION CUSTOM

    // can_read_log
    // user:operation:dasdasd

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_connexion' => 'datetime', // Changé ici
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



    // Relations inchangées
    public function statut()
    {
        return $this->belongsTo(TypeStatut::class, 'statut_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id'); // Lier users.id à admins.id
    }

    public function mutualiste()
    {
        return $this->hasOne(Mutualiste::class, 'id'); // Lier users.id à mutualistes.id
    }

    public static function queryFilters(): array
    {
        return [
            'verified' => function (Builder $query, $user) {
                $query->whereNotNull('email_verified_at');
            },
            'recent' => function (Builder $query, $user) {
                $query->where('created_at', '>=', now()->subMonth());
            },
        ];
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }


}
