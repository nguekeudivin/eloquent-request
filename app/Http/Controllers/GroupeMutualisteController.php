<?php

namespace App\Http\Controllers;

use App\Models\GroupeMutualiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;


class GroupeMutualisteController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'groupe_mutualiste:create' => [
                'nom' => ['required', 'string', 'max:255', 'unique:groupe_mutualistes,nom'], // Renommé de 'libelle' à 'nom'
            ],
        ]);

        if(isset($validated['errors'])){
            return response()->json($validated, 422);
       }

        $groupeMutualiste = GroupeMutualiste::create($validated);

        if (Auth::check()) {
             $groupeMutualiste->update(['created_by_user_id' => Auth::id()]);
             $groupeMutualiste->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Groupe mutualiste créé avec succès.', 'data' => $groupeMutualiste], 201);
    }

    public function update(Request $request, string $id)
    {
        try {
             $groupeMutualiste = GroupeMutualiste::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Groupe mutualiste non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'groupe_mutualiste:update' => [
                'nom' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('groupe_mutualistes', 'nom')->ignore($groupeMutualiste->id)], // Renommé de 'libelle' à 'nom'
            ],
        ]);

        if(isset($validated['errors'])){
            return response()->json($validated, 422);
       }

        $groupeMutualiste->fill($validated);

         if (Auth::check()) {
            $groupeMutualiste->updated_by_user_id = Auth::id();
         }

        $groupeMutualiste->save();

        return response()->json(['message' => 'Groupe mutualiste mis à jour avec succès.', 'data' => $groupeMutualiste], 200);
    }

    public function destroy(string $id)
    {
        try {
             $groupeMutualiste = GroupeMutualiste::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Groupe mutualiste non trouvé.'], 404);
        }

        try {
            $groupeMutualiste->delete();
             return response()->json(['message' => 'Groupe mutualiste supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du groupe mutualiste.', 'error' => $e->getMessage()], 500);
        }
    }
}
