<?php

namespace App\Http\Controllers;

use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Caisse;
use App\Models\CategorieSortie;
use App\Models\User;
use Illuminate\Support\Carbon;


class SortieController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'sortie:create'
        $validated = $this->validateWithPermissions($request, [
            'sortie:create' => [
                'caisse_id' => ['required', 'integer', 'exists:caisses,id'],
                'categorie_sortie_id' => ['required', 'integer', 'exists:categorie_sorties,id'],
                'date_heure_mouvement' => ['required', 'date'],
                'montant' => ['required', 'decimal:0,2', 'min:0.01'],
                'beneficiaire_motif' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'text'],
                'reference_externe' => ['nullable', 'string', 'max:255'],
                 'enregistre_par_admin_id' => ['required', 'uuid', 'exists:users,id'], // Assurez-vous que cet user est bien un admin
            ],
        ]);

        // Définir la date d'enregistrement à maintenant
        $validated['date_enregistrement'] = now();

        $sortie = Sortie::create($validated);

        if (Auth::check()) {
             $sortie->update([
                 'created_by_user_id' => Auth::id(),
                 'updated_by_user_id' => Auth::id(),
            ]);
             $sortie->created_by_user_id = Auth::id();
             $sortie->updated_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Sortie enregistrée avec succès.', 'data' => $sortie], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'sortie:update'
        try {
             $sortie = Sortie::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Sortie non trouvée.'], 404);
        }

        // Note: La mise à jour de certains champs (ex: caisse_id, categorie_sortie_id, enregistre_par_admin_id)
        // peut être restreinte selon les règles métier ou les permissions.
        $validated = $this->validateWithPermissions($request, [
            'sortie:update' => [
                'caisse_id' => ['sometimes', 'required', 'integer', 'exists:caisses,id'],
                'categorie_sortie_id' => ['sometimes', 'required', 'integer', 'exists:categorie_sorties,id'],
                'date_heure_mouvement' => ['sometimes', 'required', 'date'],
                'montant' => ['sometimes', 'required', 'decimal:0,2', 'min:0.01'],
                'beneficiaire_motif' => ['sometimes', 'required', 'string', 'max:255'],
                'description' => ['nullable', 'text'],
                'reference_externe' => ['nullable', 'string', 'max:255'],
                 'enregistre_par_admin_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'], // Assurez-vous que cet user est bien un admin
            ],
        ]);

        $sortie->fill($validated);

         if (Auth::check()) {
            $sortie->updated_by_user_id = Auth::id();
         }

        $sortie->save();

        return response()->json(['message' => 'Sortie mise à jour avec succès.', 'data' => $sortie], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'sortie:delete'
        try {
             $sortie = Sortie::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Sortie non trouvée.'], 404);
        }

        try {
            $sortie->delete();
             return response()->json(['message' => 'Sortie supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la Sortie.', 'error' => $e->getMessage()], 500);
        }
    }
}
