<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Trait pour les UUID
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User; // Pour les relations d'audit
use App\Models\TypeAyantDroit; // Pour la relation BelongsTo
use App\Models\Mutualiste; // Pour la relation BelongsTo (partage l'ID User)


class AyantDroit extends Model
{
    use HasFactory, HasUuids; // Utilisation du trait HasUuids

    protected $primaryKey = 'id';
    protected $keyType = 'string'; // Type de clé primaire est string (UUID)
    public $incrementing = false; // La clé primaire n'est pas auto-incrémentée

    protected $fillable = [
        'type_ayant_droit_id',
        'mutualiste_id',
        'nom',
        'prenom',
        'date_naissance',
        'sexe',
        'est_actif',
    ];

    protected $casts = [
        'type_ayant_droit_id' => 'int', // Caster l'ID type en int
        'mutualiste_id' => 'string', // Caster l'ID mutualiste en string (UUID)
        'date_naissance' => 'date', // Caster la date de naissance
        'sexe' => 'string', // Caster l'ENUM en string
        'est_actif' => 'boolean', // Caster le booléen
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     protected $guarded = [
         'id', // ID généré par HasUuids
         'created_by_user_id', // Champs d'audit gérés automatiquement
         'updated_by_user_id',
         'created_at',
         'updated_at',
     ];

    // Relation vers le type d'ayant droit
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeAyantDroit::class, 'type_ayant_droit_id');
    }

    // Relation vers le mutualiste principal
    public function mutualiste(): BelongsTo
    {
        // mutualiste_id référence l'ID dans la table users/mutualistes
        return $this->belongsTo(Mutualiste::class, 'mutualiste_id');
    }

    // Relation vers l'utilisateur qui a créé l'ayant droit
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // Relation vers l'utilisateur qui a mis à jour l'ayant droit pour la dernière fois
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    /**
     * Désactive l'ayant droit en mettant 'est_actif' à false.
     */
    public function desactiver(): bool
    {
        $this->est_actif = false;
        return $this->save();
    }

    /**
     * Active l'ayant droit en mettant 'est_actif' à true.
     */
    public function activer(): bool
    {
        $this->est_actif = true;
        return $this->save();
    }


    /**
     * Define query filters for listing ayant_droits.
     *
     * @return array<string, \Closure>
     */
    public static function queryFilters(): array
    {
        return [
            // Filter by mutualiste_id
            'mine' => function (\Illuminate\Database\Eloquent\Builder $query, string $user) {
                $query->where('mutualiste_id', $user_id);
            },
        ];
    }
}
