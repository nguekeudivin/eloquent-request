<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255|unique:roles,nom',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role = new Role();
        $role->fill($validator->validated());

        if (Auth::check()) {
             $role->created_by_user_id = Auth::id();
        }

        $role->save();

        return response()->json(['message' => 'Rôle créé avec succès.', 'data' => $role], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:255|unique:roles,nom,' . $id,
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé.'], 404);
        }

        $role->fill($validator->validated());

         if (Auth::check()) {
            $role->updated_by_user_id = Auth::id();
         }

        $role->save();

        return response()->json(['message' => 'Rôle mis à jour avec succès.', 'data' => $role], 200);
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé.'], 404);
        }

        try {
            $role->delete();
             return response()->json(['message' => 'Rôle supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du rôle. Il est peut-être utilisé ailleurs (référencé par une clé étrangère).', 'error' => $e->getMessage()], 500);
        }
    }
}
