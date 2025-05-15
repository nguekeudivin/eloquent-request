<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Carbon;


class Message extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'date_envoi',
        'contenu',
        'est_lu',
    ];

    protected $casts = [
        'conversation_id' => 'string',
        'user_id' => 'string',
        'date_envoi' => 'datetime',
        'est_lu' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     protected $guarded = [
         'id',
         'created_at',
         'updated_at',
     ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Enregistre que ce message a été lu par un utilisateur spécifique.
     * Nécessite une structure pour suivre la lecture par destinataire.
     *
     * @param string $userId L'ID de l'utilisateur qui a lu le message.
     * @return bool Succès de l'opération.
     */
    // public function marquerLu(string $userId): bool
    // {
        // Implémenter la logique de marquage lu par utilisateur ici
        // Ex: $this->lectures()->create(['user_id' => $userId]);
        // return true; // ou false
    // }
}
