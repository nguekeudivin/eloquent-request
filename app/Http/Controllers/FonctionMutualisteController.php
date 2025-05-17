<?php

namespace App\Http\Controllers;

use App\Models\FonctionMutualiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\GroupeMutualiste; // Pour la validation exists


class FonctionMutualisteController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'fonction_mutualiste:create' => [
                'libelle' => [
                    'required',
                    'string',
                    'max:255',
                    // Règle d'unicité composite : le libellé doit être unique DANS CE groupe_mutualiste_id
                    Rule::unique('fonction_mutualistes')->where(function ($query) use ($request) {
                        return $query->where('groupe_mutualiste_id', $request->groupe_mutualiste_id);
                    })
                ],
                // Valide que groupe_mutualiste_id est requis, est un integer et existe dans la table groupe_mutualistes
                'groupe_mutualiste_id' => ['required', 'integer', 'exists:groupe_mutualistes,id'],
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }

        // Créer la fonction en utilisant create()
        $fonctionMutualiste = FonctionMutualiste::create($validated);

        // Définir le champ created_by_user_id après la création car il est gardé
        if (Auth::check()) {
             $fonctionMutualiste->update(['created_by_user_id' => Auth::id()]);
             $fonctionMutualiste->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Fonction mutualiste créée avec succès.', 'data' => $fonctionMutualiste], 201);
    }

    public function update(Request $request, string $id)
    {
        try {
             $fonctionMutualiste = FonctionMutualiste::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Fonction mutualiste non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'fonction_mutualiste:update' => [
                'nom' => [
                    'sometimes', // Le libellé n'est pas toujours mis à jour
                    'required',
                    'string',
                    'max:255',
                     // Règle d'unicité composite pour la mise à jour :
                     // Le libellé doit être unique DANS le groupe_mutualiste_id (qui peut être celui de l'instance actuelle ou un nouveau si le groupe_id est modifié)
                     Rule::unique('fonction_mutualistes')->where(function ($query) use ($request, $fonctionMutualiste) {
                         // Utilise le groupe_mutualiste_id de la requête s'il est présent, sinon celui de l'instance actuelle
                         $groupeId = $request->has('groupe_mutualiste_id') ? $request->groupe_mutualiste_id : $fonctionMutualiste->groupe_mutualiste_id;
                         return $query->where('groupe_mutualiste_id', $groupeId);
                     })->ignore($fonctionMutualiste->id) // Ignore l'instance actuelle
                ],
                 // Permettre la mise à jour du groupe_mutualiste_id si la permission le permet
                 'groupe_mutualiste_id' => ['sometimes', 'required', 'integer', 'exists:groupe_mutualistes,id'],
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }

        $fonctionMutualiste->fill($validated);

        $fonctionMutualiste->groupe_mutualiste;

         if (Auth::check()) {
            $fonctionMutualiste->updated_by_user_id = Auth::id();
         }

        $fonctionMutualiste->save();

        return response()->json(['message' => 'Fonction mutualiste mise à jour avec succès.', 'data' => $fonctionMutualiste], 200);
    }

    public function destroy(string $id)
    {
        try {
             $fonctionMutualiste = FonctionMutualiste::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Fonction mutualiste non trouvée.'], 404);
        }

        try {
            $fonctionMutualiste->delete();
             return response()->json(['message' => 'Fonction mutualiste supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la fonction mutualiste.', 'error' => $e->getMessage()], 500);
        }
    }
}
