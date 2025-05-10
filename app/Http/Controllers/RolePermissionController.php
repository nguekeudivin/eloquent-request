<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class RolePermissionController extends Controller
{
    // Attacher une permission à un rôle
    // POST /api/roles/{roleId}/permissions
    public function attachPermission(Request $request, string $roleId)
    {
        $validator = Validator::make($request->all(), [
            'permission_id' => 'required|string|size:36|exists:permissions,id',
            'date_attribution' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $role = Role::find($roleId);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé.'], 404);
        }

        $permissionId = $validator->validated()['permission_id'];
        $dateAttribution = $validator->validated()['date_attribution'] ?? Carbon::now();

        $pivotData = [
            'date_attribution' => $dateAttribution,
        ];

        if (Auth::check()) {
            $pivotData['created_by_user_id'] = Auth::id();
        }

         if ($role->permissions()->where('permission_id', $permissionId)->exists()) {
             return response()->json(['message' => 'Cette permission est déjà attribuée à ce rôle.'], 409);
         }


        $role->permissions()->attach($permissionId, $pivotData);

        return response()->json(['message' => 'Permission attribuée avec succès au rôle.'], 200);
    }

    // Détacher une permission d'un rôle
    // DELETE /api/roles/{roleId}/permissions/{permissionId}
    public function detachPermission(string $roleId, string $permissionId)
    {
        $role = Role::find($roleId);

        if (!$role) {
            return response()->json(['message' => 'Rôle non trouvé.'], 404);
        }

        $permission = Permission::find($permissionId);

        if (!$permission) {
             return response()->json(['message' => 'Permission non trouvée.'], 404);
        }

        $detached = $role->permissions()->detach($permissionId);

        if ($detached) {
            return response()->json(['message' => 'Permission retirée avec succès du rôle.'], 200);
        } else {
             return response()->json(['message' => 'Cette attribution de permission n\'existe pas pour ce rôle.'], 404);
        }
    }

    // Lister les permissions d'un rôle
    // GET /api/roles/{roleId}/permissions
     public function listPermissions(string $roleId)
     {
         $role = Role::find($roleId);

         if (!$role) {
             return response()->json(['message' => 'Rôle non trouvé.'], 404);
         }

         $permissions = $role->permissions()->withPivot('date_attribution', 'created_at', 'updated_at', 'created_by_user_id', 'updated_by_user_id')->get();

         return response()->json(['role_id' => $roleId, 'permissions' => $permissions], 200);
     }
}
