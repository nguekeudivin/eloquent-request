<?php

namespace App\Http\Controllers;

use App\Models\CategorieSortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;


class CategorieSortieController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'categorie_sortie:create'
        $validated = $this->validateWithPermissions($request, [
            'categorie_sortie:create' => [
                'libelle' => ['required', 'string', 'max:255', 'unique:categorie_sorties,libelle'],
                'description' => ['nullable', 'string', 'max:255'],
               // 'est_active' => ['boolean'],
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }

         if (!isset($validated['est_active'])) {
             $validated['est_active'] = true;
         }

        $categorieSortie = CategorieSortie::create($validated);

        if (Auth::check()) {
             $categorieSortie->update(['created_by_user_id' => Auth::id()]);
             $categorieSortie->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'CategorieSortie créée avec succès.', 'data' => $categorieSortie], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'categorie_sortie:update'
        try {
             $categorieSortie = CategorieSortie::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'CategorieSortie non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'categorie_sortie:update' => [
                'libelle' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('categorie_sorties', 'libelle')->ignore($categorieSortie->id)],
                'description' => ['nullable', 'string', 'max:255'],
                'est_active' => ['sometimes', 'boolean'],
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }

        $categorieSortie->fill($validated);

         if (Auth::check()) {
            $categorieSortie->updated_by_user_id = Auth::id();
         }

        $categorieSortie->save();

        return response()->json(['message' => 'CategorieSortie mise à jour avec succès.', 'data' => $categorieSortie], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'categorie_sortie:delete'
        try {
             $categorieSortie = CategorieSortie::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'CategorieSortie non trouvée.'], 404);
        }

        try {
            $categorieSortie->delete();
             return response()->json(['message' => 'CategorieSortie supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la CategorieSortie.', 'error' => $e->getMessage()], 500);
        }
    }
}
