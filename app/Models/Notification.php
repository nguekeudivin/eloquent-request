<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'type_notification',
        'titre',
        'contenu',
        'est_lue',
        'date_lecture',
        'lien_cible',
    ];

    protected $casts = [
        'est_lue' => 'boolean',
        'date_lecture' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    // Relation vers l'utilisateur destinataire de la notification
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relations d'audit retirées

    /**
     * Define query filters for listing notifications.
     *
     * @return array<string, \Closure>
     */
    public static function queryFilters(): array
    {
        return [
            'mine' => function (Builder $query, $user) {
                $query->where('user_id', $user->id);
            },
        ];
    }
}
