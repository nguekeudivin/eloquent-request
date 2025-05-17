<?php

namespace App\Http\Controllers;

use App\Models\AyantDroit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\TypeAyantDroit; // Pour validation exists
use App\Models\Mutualiste; // Pour validation exists (via users table)


class AyantDroitController extends Controller
{
    use PermissionValidator;

    // Méthode 'creer(donneesAyantDroit, mutualisteId)' -> store
    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'ayant_droit:create' => [ // Permission pattern prefix
                'type_ayant_droit_id' => ['required', 'integer', 'exists:type_ayant_droits,id'],
                // mutualiste_id référence l'ID user, donc validation sur la table users
                'mutualiste_id' => ['required', 'uuid', 'exists:users,id'],
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string', 'max:255'],
                'date_naissance' => ['required', 'date'],
                'sexe' => ['required', 'string', Rule::in(['MASCULIN', 'FEMININ'])],
                // est_actif par défaut à true, peut être omis ou validé si permis
                 'est_actif' => ['boolean'],
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }

        // Créer l'ayant droit en utilisant create()
        $ayantDroit = AyantDroit::create($validated);

        // Définir le champ created_by_user_id après la création car il est gardé
        if (Auth::check()) {
             $ayantDroit->update(['created_by_user_id' => Auth::id()]);
             $ayantDroit->created_by_user_id = Auth::id();
        }

        $ayantDroit->load('type_ayant_droit');

        return response()->json(['message' => 'AyantDroit créé avec succès.', 'data' => $ayantDroit], 201);
    }

    // Méthode 'modifier(donnees)' -> update
    public function update(Request $request, string $id)
    {
        try {
             $ayantDroit = AyantDroit::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'AyantDroit non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'ayant_droit:update' => [ // Permission pattern prefix
                'type_ayant_droit_id' => ['sometimes', 'required', 'integer', 'exists:type_ayant_droits,id'],
                // mutualiste_id peut potentiellement être mis à jour si permis
                'mutualiste_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
                'nom' => ['sometimes', 'required', 'string', 'max:255'],
                'prenom' => ['sometimes', 'required', 'string', 'max:255'],
                'date_naissance' => ['sometimes', 'required', 'date'],
                'sexe' => ['sometimes', 'required', 'string', Rule::in(['MASCULIN', 'FEMININ'])],
                'est_actif' => ['sometimes', 'boolean'],
            ],
        ]);

        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }

        $ayantDroit->fill($validated);

         if (Auth::check()) {
            $ayantDroit->updated_by_user_id = Auth::id();
         }

        $ayantDroit->save();

        $ayantDroit->load('type_ayant_droit');

        return response()->json(['message' => 'AyantDroit mis à jour avec succès.', 'data' => $ayantDroit], 200);
    }


    public function deactivate(string $id)
    {
        // Permission check for the deactivate operation
        // e.g., Auth::user()->can('ayant_droit:desactiver') and Auth::user()->can('desactiver', $ayantDroit) Policy check

        try {
             $ayantDroit = AyantDroit::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'AyantDroit non trouvé.'], 404);
        }

         // Policy check
         // if (Auth::check() && Auth::user()->cannot('desactiver', $ayantDroit)) {
         //      abort(403, 'Vous n\'êtes pas autorisé à désactiver cet ayant droit.');
         // }

        // Utilise la méthode du modèle pour désactiver
        $success = $ayantDroit->desactiver(); // Esto llama a $this->save() dentro del modelo

        if ($success) {
             // Optionnel : Mettre à jour updated_by_user_id également ici si l'opération est loguée séparément
             if (Auth::check()) {
                 $ayantDroit->update(['updated_by_user_id' => Auth::id()]);
                 $ayantDroit->updated_by_user_id = Auth::id(); // Mettre à jour l'instance en mémoire
             }
             return response()->json(['message' => 'AyantDroit désactivé avec succès.', 'data' => $ayantDroit], 200);
        } else {
             return response()->json(['message' => 'Échec de la désactivation de l\'AyantDroit.'], 500);
        }
    }

     public function destroy(string $id)
     {
         // Permission check for deleting an ayant_droit
        // e.g., Auth::user()->can('ayant_droit:delete') and Auth::user()->can('delete', $ayantDroit) Policy check

        try {
             $ayantDroit = AyantDroit::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'AyantDroit non trouvé.'], 404);
        }

         // Policy check
         // if (Auth::check() && Auth::user()->cannot('delete', $ayantDroit)) {
         //      abort(403, 'Vous n\'êtes pas autorisé à supprimer cet ayant droit.');
         // }

        try {
            $ayantDroit->delete();
             return response()->json(['message' => 'AyantDroit supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de l\'AyantDroit.', 'error' => $e->getMessage()], 500);
        }
     }
}
