<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Caisse;
use App\Models\CategorieEntree;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Support\Carbon;


class Entree extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'entrees';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'caisse_id',
        'categorie_entree_id',
        'date_heure_mouvement',
        'montant',
        'source_motif',
        'description',
        'reference_externe',
        'paiement_id',
        'date_enregistrement',
        'enregistre_par_admin_id',
    ];

    protected $casts = [
        'caisse_id' => 'int',
        'categorie_entree_id' => 'int',
        'date_heure_mouvement' => 'datetime',
        'montant' => 'decimal:2',
        'paiement_id' => 'string',
        'date_enregistrement' => 'datetime',
        'enregistre_par_admin_id' => 'string',
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

    public function caisse(): BelongsTo
    {
        return $this->belongsTo(Caisse::class, 'caisse_id');
    }

    public function categorieEntree(): BelongsTo
    {
        return $this->belongsTo(CategorieEntree::class, 'categorie_entree_id');
    }

    public function paiement(): BelongsTo
    {
        return $this->belongsTo(Paiement::class, 'paiement_id');
    }

    public function enregistreParAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enregistre_par_admin_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    /**
     * Enregistre un mouvement d'entrée d'argent dans une caisse.
     *
     * @param array $data Les données de l'entrée.
     * @param string $adminId L'ID de l'admin qui enregistre.
     * @param string|null $paiementId L'ID du paiement associé (optionnel).
     * @return Entree Le modèle Entree créé.
     */
    // public static function enregistrer(array $data, string $adminId, ?string $paiementId = null): Entree
    // {
        // $data['enregistre_par_admin_id'] = $adminId;
        // $data['paiement_id'] = $paiementId;
        // $data['date_enregistrement'] = now();
        // return self::create($data);
    // }


    public static function queryFilters(): array
    {
        return [
            'caisse' => function (\Illuminate\Database\Eloquent\Builder $query, int $caisseId) {
                $query->where('caisse_id', $caisseId);
            },
            'categorie' => function (\Illuminate\Database\Eloquent\Builder $query, int $categorieId) {
                 $query->where('categorie_entree_id', $categorieId);
            },
             'paiement' => function (\Illuminate\Database\Eloquent\Builder $query, string $paiementId) {
                 $query->where('paiement_id', $paiementId);
             },
             'enregistre_par' => function (\Illuminate\Database\Eloquent\Builder $query, string $adminId) {
                 $query->where('enregistre_par_admin_id', $adminId);
             },
             'date_mouvement_after' => function (\Illuminate\Database\Eloquent\Builder $query, string $date) {
                 $query->where('date_heure_mouvement', '>=', $date);
             },
              'date_mouvement_before' => function (\Illuminate\Database\Eloquent\Eloquent\Builder $query, string $date) {
                 $query->where('date_heure_mouvement', '<=', $date);
             },
             'date_enregistrement_after' => function (\Illuminate\Database\Eloquent\Builder $query, string $date) {
                 $query->where('date_enregistrement', '>=', $date);
             },
              'date_enregistrement_before' => function (\Illuminate\Database\Eloquent\Eloquent\Builder $query, string $date) {
                 $query->where('date_enregistrement', '<=', $date);
             },
        ];
    }
}
