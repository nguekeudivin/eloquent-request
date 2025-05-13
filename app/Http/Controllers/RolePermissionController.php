<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RolePermissionController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'role_permission:create' => [
                'role_id' => ['required', 'integer', 'exists:roles,id'],
                'permission_id' => ['required', 'integer', 'exists:permissions,id'],
            ],
        ]);

        $data = $validated;

        if (RolePermission::where('role_id', $data['role_id'])
                          ->where('permission_id', $data['permission_id'])
                          ->exists()) {
            return response()->json(['message' => 'Ce lien rôle-permission existe déjà.'], 409);
        }

        $rolePermission = new RolePermission();
        $rolePermission->fill($data);

        if (Auth::check()) {
             $rolePermission->created_by_user_id = Auth::id();
        }

        $rolePermission->save();

        return response()->json(['message' => 'Lien rôle-permission créé avec succès.', 'data' => $rolePermission], 201);
    }


    public function update(Request $request, string $roleId, string $permissionId)
    {
        $roleIdInt = (int) $roleId;
        $permissionIdInt = (int) $permissionId;

        try {
             $rolePermission = RolePermission::where('role_id', $roleIdInt)
                                            ->where('permission_id', $permissionIdInt)
                                            ->firstOrFail();
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Lien rôle-permission non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'role_permission:update' => [
                 // Define updatable fields here if any (e.g., custom_field)
            ],
        ]);

        $rolePermission->fill($validated);

         if (Auth::check()) {
            $rolePermission->updated_by_user_id = Auth::id();
         }

        $rolePermission->save();

        return response()->json(['message' => 'Lien rôle-permission mis à jour avec succès.', 'data' => $rolePermission], 200);
    }

    public function destroy(string $roleId, string $permissionId)
    {
        $roleIdInt = (int) $roleId;
        $permissionIdInt = (int) $permissionId;

        try {
             $rolePermission = RolePermission::where('role_id', $roleIdInt)
                                            ->where('permission_id', $permissionIdInt)
                                            ->firstOrFail();

            $rolePermission->delete();
             return response()->json(['message' => 'Lien rôle-permission supprimé avec succès.'], 200);

        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Lien rôle-permission non trouvé.'], 404);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du lien rôle-permission.', 'error' => $e->getMessage()], 500);
        }
    }
}
