<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Trouver l'utilisateur manuellement par username
        $user = User::where('username', $request->username)->first();

        // Vérifier si l'utilisateur existe ET si le mot de passe fourni correspond au haché
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        // Authentification réussie (validation manuelle passée)
        $user->load('admin', 'mutualiste');

        // Déterminer le type d'utilisateur
        $userType = null; // Type par défaut

        if ($user->admin !== null) {
            $userType = 'admin';
        } elseif ($user->mutualiste !== null) {
            $userType = 'mutualiste';
        }
        // Générer un nouveau token Sanctum pour cet utilisateur
        $token = $user->createToken('api-token')->plainTextToken;

       // $user->permissions = $user->getPermissions();

        // Retourner les détails de l'utilisateur et le token
        return response()->json([
            'message' => 'Connexion réussie',
            'user' => $user,
            'user_type' => $userType,
            'token' => $token,
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Deconnexion reussie'], 200);
    }

    public function me(Request $request)
    {
        $user = $request->user(); // Récupère l'utilisateur authentifié

        $user->permissions = $user->getPermissions();

        // Charger les relations admin et mutualiste
        $user->load('admin', 'mutualiste');

        $userType = null;

        if ($user->admin !== null) {
            $userType = 'admin';
        } elseif ($user->mutualiste !== null) {
            $userType = 'mutualiste';
        }

        // Retourner les détails de l'utilisateur et son type
        return response()->json([
            'user' => $user,
            'user_type' => $userType, // Ajouter le type d'utilisateur
        ]);
    }
}
