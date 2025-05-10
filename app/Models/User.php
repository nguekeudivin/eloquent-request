<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'username',
        'email',
        'password',
        'statut_id',
        'last_connexion', // Changé ici
    ];

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
}
