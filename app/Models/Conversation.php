<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo; // Pour la relation polymorphique
use App\Models\User;
// Importer les modèles qui peuvent être conversationable (ex: Réclamation, Adhesion)
// use App\Models\Réclamation;
// use App\Models\Adhesion;
// Importer les modèles pour les relations (ConversationParticipant, Message)
// use App\Models\ConversationParticipant;
// use App\Models\Message;
use Illuminate\Support\Carbon;


class Conversation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'conversations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'sujet',
        'date_creation',
        'statut',
        'conversationable_type',
        'conversationable_id',
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'statut' => 'string',
        'conversationable_id' => 'string', // Caster l'ID polymorphique en string (UUID)
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     protected $guarded = [
         'id',
         'created_by_user_id',
         'updated_by_user_id',
         'created_at',
         'updated_at',
     ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    // Relation polymorphique vers le modèle parent (ex: Réclamation, Adhesion)
    public function conversationable(): MorphTo
    {
        return $this->morphTo();
    }

    // Relation HasMany vers les participants (nécessite un modèle ConversationParticipant)
    // public function participants(): HasMany
    // {
    //     return $this->hasMany(ConversationParticipant::class, 'conversation_id');
    // }

    // Relation HasMany vers les messages (nécessite un modèle Message)
    // public function messages(): HasMany
    // {
    //     return $this->hasMany(Message::class, 'conversation_id');
    // }


    /**
     * Change le statut à "fermé".
     *
     * @return bool Succès de la sauvegarde.
     */
    public function cloturer(): bool
    {
        // Ne fermer que si le statut n'est pas déjà 'fermé' ou 'archivé'
        if (!in_array($this->statut, ['fermé', 'archivé'])) {
             $this->statut = 'fermé';
             return $this->save();
        }
        return false;
    }

    /**
     * Ajoute un participant à la conversation.
     * Nécessite un modèle ConversationParticipant et une relation.
     *
     * @param string $userId L'ID de l'utilisateur à ajouter.
     * @return bool Succès de l'opération.
     */
    // public function ajouterParticipant(string $userId): bool
    // {
        // Implémenter la logique d'ajout de participant ici
        // Ex: $this->participants()->create(['user_id' => $userId]);
        // return true; // ou false
    // }

    /**
     * Envoie un message dans la conversation.
     * Nécessite un modèle Message et une relation.
     *
     * @param string $userId L'ID de l'utilisateur qui envoie le message.
     * @param string $contenu Le contenu du message.
     * @return mixed Le modèle Message créé ou false en cas d'échec.
     */
    // public function envoyerMessage(string $userId, string $contenu): mixed
    // {
        // Implémenter la logique d'envoi de message ici
        // Ex: return $this->messages()->create(['user_id' => $userId, 'contenu' => $contenu]);
        // return false;
    // }

}
