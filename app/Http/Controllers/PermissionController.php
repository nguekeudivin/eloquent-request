<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;

class PermissionController extends Controller
{

    use PermissionValidator;

    public function store(Request $request)
    {
        // Récupérer les permissions de l'utilisateur connecté (c'est un exemple,
        // la manière exacte de récupérer les permissions dépend de votre système d'authentification/autorisation)
        $userPermissions = [
            "user:create",
            "user:create:email",
            "user:create:password",
            "user:create:name",
            "profile:create"
        ];

        // Définir les règles de validation basées sur les permissions
        $rules = [
            'user:create' => [
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            'profile:create' => [
                'name' => ['required', 'string', 'max:255'],
            ],
            'meta' => [
                'ref_code' => ['required', 'string'],
                'send_email' => ['boolean'],
            ],
        ];

        // Valider la requête en utilisant la méthode du trait
        $validationResult = $this->validateWithPermissions($request, $rules, $userPermissions);

        // Vérifier si la validation a réussi ou échoué
        if (is_array($validationResult) && isset($validationResult['errors'])) {
            // La validation a échoué (manque de permissions ou erreurs de validation Laravel)
            return response()->json($validationResult, 422); // Code d'erreur pour "Unprocessable Entity"
        } else {


            return response()->json(['message' => 'Utilisateur créé avec succès'], 201); // Code 201 pour "Created"
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'string|max:255|unique:permissions,code,' . $id, // Nom de colonne changé ici
            'description' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission non trouvée.'], 404);
        }

        $permission->fill($validator->validated());

         if (Auth::check()) {
            $permission->updated_by_user_id = Auth::id();
         }

        $permission->save();

        return response()->json(['message' => 'Permission mise à jour avec succès.', 'data' => $permission], 200);
    }

    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['message' => 'Permission non trouvée.'], 404);
        }

        try {
            $permission->delete();
             return response()->json(['message' => 'Permission supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la permission. Elle est peut-être utilisée ailleurs (référencée par une clé étrangère).', 'error' => $e->getMessage()], 500);
        }
    }
}
