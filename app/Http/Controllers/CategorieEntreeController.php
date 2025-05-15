<?php

namespace App\Http\Controllers;

use App\Models\CategorieEntree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;


class CategorieEntreeController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'categorie_entree:create'
        $validated = $this->validateWithPermissions($request, [
            'categorie_entree:create' => [
                'libelle' => ['required', 'string', 'max:255', 'unique:categorie_entrees,libelle'],
                'description' => ['nullable', 'string', 'max:255'],
                'est_actif' => ['boolean'],
            ],
        ]);

        if (!isset($validated['est_actif'])) {
             $validated['est_actif'] = true;
         }

        $categorieEntree = CategorieEntree::create($validated);

        if (Auth::check()) {
             $categorieEntree->update(['created_by_user_id' => Auth::id()]);
             $categorieEntree->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'CategorieEntree créée avec succès.', 'data' => $categorieEntree], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'categorie_entree:update'
        try {
             $categorieEntree = CategorieEntree::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'CategorieEntree non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'categorie_entree:update' => [
                'libelle' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('categorie_entrees', 'libelle')->ignore($categorieEntree->id)],
                'description' => ['nullable', 'string', 'max:255'],
                'est_actif' => ['sometimes', 'boolean'],
            ],
        ]);

        $categorieEntree->fill($validated);

         if (Auth::check()) {
            $categorieEntree->updated_by_user_id = Auth::id();
         }

        $categorieEntree->save();

        return response()->json(['message' => 'CategorieEntree mise à jour avec succès.', 'data' => $categorieEntree], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'categorie_entree:delete'
        try {
             $categorieEntree = CategorieEntree::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'CategorieEntree non trouvée.'], 404);
        }

        try {
            $categorieEntree->delete();
             return response()->json(['message' => 'CategorieEntree supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la CategorieEntree.', 'error' => $e->getMessage()], 500);
        }
    }
}
