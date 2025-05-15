<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Entree;


class CategorieEntree extends Model
{
    use HasFactory;

    protected $table = 'categorie_entrees';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'libelle',
        'description',
        'est_actif',
    ];

    protected $casts = [
        'est_actif' => 'boolean',
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

    public function entrees(): HasMany
    {
        return $this->hasMany(Entree::class, 'categorie_entree_id');
    }

    /**
     * Change le statut "est_actif" à false.
     *
     * @return bool Succès de la sauvegarde.
     */
    public function desactiver(): bool
    {
        $this->est_actif = false;
        return $this->save();
    }

    /**
     * Change le statut "est_actif" à true.
     *
     * @return bool Succès de la sauvegarde.
     */
    public function activer(): bool
    {
        $this->est_actif = true;
        return $this->save();
    }


    public static function queryFilters(): array
    {
        return [
            'libelle' => function (\Illuminate\Database\Eloquent\Builder $query, string $libelle) {
                $query->where('libelle', 'like', '%' . $libelle . '%');
            },
             'actif' => function (\Illuminate\Database\Eloquent\Builder $query, bool $isActive = true) {
                 $query->where('est_actif', $isActive);
             },
        ];
    }
}
