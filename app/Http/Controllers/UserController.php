<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StatusType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'statut_id' => 'required|integer|exists:status_types,id',
            'last_connexion' => 'nullable|date', // Changé ici
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $userData = $validator->validated();
        $userData['password'] = Hash::make($userData['password']);

        $user->fill($userData);
        $user->save();

        return response()->json(['message' => 'Utilisateur créé avec succès.', 'data' => $user], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'string|max:255|unique:users,username,' . $id,
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'statut_id' => 'integer|exists:status_types,id',
            'last_connexion' => 'nullable|date', // Changé ici
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        $userData = $validator->validated();

        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }

        $user->fill($userData);
        $user->save();

        return response()->json(['message' => 'Utilisateur mis à jour avec succès.', 'data' => $user], 200);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        try {
            $user->delete();
             return response()->json(['message' => 'Utilisateur supprimé avec succès.', 'user_id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de l\'utilisateur. Il est peut-être utilisé ailleurs (référencé par une clé étrangère).', 'error' => $e->getMessage()], 500);
        }
    }
}
