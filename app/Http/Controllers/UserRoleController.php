<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRoleController extends Controller
{
    use PermissionValidator;


    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'user_role:create' => [
                'user_id' => ['required', 'string', 'size:36', 'exists:users,id'],
                'role_id' => ['required', 'integer', 'exists:roles,id'],
            ],
        ]);

        $data = $validated;

        if (UserRole::where('user_id', $data['user_id'])
                    ->where('role_id', $data['role_id'])
                    ->exists()) {
            return response()->json(['message' => 'Ce lien utilisateur-rôle existe déjà.'], 409);
        }

        $userRole = new UserRole();
        $userRole->fill($data);

        if (Auth::check()) {
             $userRole->created_by_user_id = Auth::id();
        }

        $userRole->save();

        return response()->json(['message' => 'Lien utilisateur-rôle créé avec succès.', 'data' => $userRole], 201);
    }


    public function update(Request $request, string $userId, string $roleId)
    {
        $roleIdInt = (int) $roleId;

        try {
             $userRole = UserRole::where('user_id', $userId)
                                ->where('role_id', $roleIdInt)
                                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Lien utilisateur-rôle non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'user_role:update' => [
                 // Define updatable fields here if any (e.g., custom_field, audit fields if allowing override)
            ],
        ]);

        $userRole->fill($validated);

         if (Auth::check()) {
            $userRole->updated_by_user_id = Auth::id();
         }

        $userRole->save();

        return response()->json(['message' => 'Lien utilisateur-rôle mis à jour avec succès.', 'data' => $userRole], 200);
    }

    public function destroy(string $userId, string $roleId)
    {
        $roleIdInt = (int) $roleId;

        try {
             $userRole = UserRole::where('user_id', $userId)
                                ->where('role_id', $roleIdInt)
                                ->firstOrFail();

            $userRole->delete();
             return response()->json(['message' => 'Lien utilisateur-rôle supprimé avec succès.'], 200);

        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Lien utilisateur-rôle non trouvé.'], 404);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du lien utilisateur-rôle.', 'error' => $e->getMessage()], 500);
        }
    }
}
