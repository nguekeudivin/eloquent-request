<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Carbon;


class ConversationParticipant extends Pivot
{
    protected $table = 'conversation_participant';

    protected $casts = [
        'conversation_id' => 'string',
        'utilisateur_id' => 'string',
        'date_jointure' => 'datetime',
        'est_actif' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     protected $guarded = [
        'conversation_id',
        'utilisateur_id',
        'created_at',
        'updated_at',
     ];


     public function conversation(): BelongsTo
     {
         return $this->belongsTo(Conversation::class, 'conversation_id');
     }

      public function utilisateur(): BelongsTo
     {
         return $this->belongsTo(User::class, 'utilisateur_id');
     }

    /**
     * Change le statut "est_actif" à false pour retirer le participant.
     *
     * @return bool Succès de la sauvegarde.
     */
    public function retirerParticipant(): bool
    {
        $this->est_actif = false;
        return $this->save();
    }

    /**
     * Change le statut "est_actif" à true pour réactiver le participant.
     *
     * @return bool Succès de la sauvegarde.
     */
    public function reactiverParticipant(): bool
    {
        $this->est_actif = true;
        return $this->save();
    }
}
