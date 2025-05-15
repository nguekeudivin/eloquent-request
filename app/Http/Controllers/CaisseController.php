<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;


class CaisseController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'caisse:create'
        $validated = $this->validateWithPermissions($request, [
            'caisse:create' => [
                'nom' => ['required', 'string', 'max:255', 'unique:caisses,nom'],
                'description' => ['nullable', 'string', 'max:255'],
                'devise' => ['required', 'string', 'max:10'],
            ],
        ]);

        $caisse = Caisse::create($validated);

        if (Auth::check()) {
             $caisse->update(['created_by_user_id' => Auth::id()]);
             $caisse->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Caisse créée avec succès.', 'data' => $caisse], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'caisse:update'
        try {
             $caisse = Caisse::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Caisse non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'caisse:update' => [
                'nom' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('caisses', 'nom')->ignore($caisse->id)],
                'description' => ['nullable', 'string', 'max:255'],
                'devise' => ['sometimes', 'required', 'string', 'max:10'],
            ],
        ]);

        $caisse->fill($validated);

         if (Auth::check()) {
            $caisse->updated_by_user_id = Auth::id();
         }

        $caisse->save();

        return response()->json(['message' => 'Caisse mise à jour avec succès.', 'data' => $caisse], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'caisse:delete'
        try {
             $caisse = Caisse::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Caisse non trouvée.'], 404);
        }

        try {
            $caisse->delete();
             return response()->json(['message' => 'Caisse supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la Caisse.', 'error' => $e->getMessage()], 500);
        }
    }
}
