<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Caisse;
use App\Models\CategorieEntree;
use App\Models\User;
use Illuminate\Support\Carbon;


class EntreeController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'entree:create'
        $validated = $this->validateWithPermissions($request, [
            'entree:create' => [
                'caisse_id' => ['required',  'exists:caisses,id'],
                'categorie_entree_id' => ['required', 'integer', 'exists:categorie_entrees,id'],
                'date_heure_mouvement' => ['required', 'date'],
                'montant' => ['required', 'decimal:0,2', 'min:0.01'],
                'source_motif' => ['required', 'string', 'max:255'],
                'description' => ['nullable'],
                'reference_externe' => ['nullable', 'string', 'max:255'],
                 // enregistre_par_admin_id doit être l'utilisateur authentifié ou spécifié si permis
                 //'enregistre_par_admin_id' => ['required', 'uuid', 'exists:users,id'], // Assurez-vous que cet user est bien un admin
            ],
        ]);

        if(isset($validated['errors'])){
             return response()->json($validated, 422);
        }

        // Définir la date d'enregistrement à maintenant
        $validated['date_enregistrement'] = now();
        $validated['enregistre_par_admin_id'] = $request->user()->id;

        $entree = Entree::create($validated);

        if (Auth::check()) {
             $entree->update([
                 'created_by_user_id' => Auth::id(),
                 'updated_by_user_id' => Auth::id(),
            ]);
             $entree->created_by_user_id = Auth::id();
             $entree->updated_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Entrée enregistrée avec succès.', 'data' => $entree], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'entree:update'
        try {
             $entree = Entree::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Entrée non trouvée.'], 404);
        }

        // Note: La mise à jour de certains champs (ex: caisse_id, categorie_entree_id, enregistre_par_admin_id)
        // peut être restreinte selon les règles métier ou les permissions.
        $validated = $this->validateWithPermissions($request, [
            'entree:update' => [
                'caisse_id' => ['sometimes', 'required', 'integer', 'exists:caisses,id'],
                'categorie_entree_id' => ['sometimes', 'required', 'integer', 'exists:categorie_entrees,id'],
                'date_heure_mouvement' => ['sometimes', 'required', 'date'],
                'montant' => ['sometimes', 'required', 'decimal:0,2', 'min:0.01'],
                'source_motif' => ['sometimes', 'required', 'string', 'max:255'],
                'description' => ['nullable'],
                'reference_externe' => ['nullable', 'string', 'max:255'],
            ],
        ]);

        if(isset($validated['errors'])){
            return response()->json($validated, 422);
       }


        $entree->fill($validated);

         if (Auth::check()) {
            $entree->updated_by_user_id = Auth::id();
         }

        $entree->save();

        return response()->json(['message' => 'Entrée mise à jour avec succès.', 'data' => $entree], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'entree:delete'
        try {
             $entree = Entree::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Entrée non trouvée.'], 404);
        }

        try {
            $entree->delete();
             return response()->json(['message' => 'Entrée supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de l\'Entrée.', 'error' => $e->getMessage()], 500);
        }
    }
}
