<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;

class RoleController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'role:create' => [
                'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
                'description' => ['nullable', 'string', 'max:255'],
            ],
        ]);

        $role = new Role();
        $role->fill($validated);

        if (Auth::check()) {
             $role->created_by_user_id = Auth::id();
        }

        $role->save();

        return response()->json(['message' => 'Rôle créé avec succès.', 'data' => $role], 201);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'role:update' => [
                'name' => ['string', 'max:255', 'unique:roles,name,' . $id],
                'description' => ['nullable', 'string', 'max:255'],
            ],
        ]);

        $role->fill($validated);

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
             return response()->json(['message' => 'Erreur lors de la suppression du rôle. Il est peut-être utilisé ailleurs.', 'error' => $e->getMessage()], 500);
        }
    }
}
