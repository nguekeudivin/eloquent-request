<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\Admin;
use App\Models\User;
use App\Models\TypeStatut;
use App\Models\Role;
use App\Models\UserRole;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'service' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Recuperer le status actif.
        $actifStatus = TypeStatut::where('code_interne', 'USER_ACTIF')
                                   ->where('contexte', 'user')
                                   ->first();

        DB::beginTransaction();

        // Create l'utilisateur associee
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'statut_id' => $actifStatus->id,
            'email_verified_at' => Carbon::now(),
            //'last_connexion' => Carbon::now(),
        ]);

        // Attributes les roles
        foreach($request->roles as $code){
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => Role::where('code',$code)->first()->id
            ]);
        }

        // Enregistrer l'administrateur associe
        $admin = Admin::create([
            "id" => $user->id,
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "service" => $request->service
        ]);

        // Enregistrer l'information d'audit.
        if (Auth::check()) {
            $admin->created_by_user_id = Auth::id();
            $admin->save();
        }

        DB::commit();


        return response()->json(['message' => 'Administrateur créé avec succès.', 'data' => $admin], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'service' => 'nullable|string|max:255',
            'email' => 'string|max:255|email',
            'username' => 'string|max:255|unique:users,username,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find both records
        $admin = Admin::find($id);
        $user = User::find($id);

        if (!$admin || !$user) {
            return response()->json(['message' => 'Administrateur non trouvé.'], 404);
        }

        $data = $validator->validated();

        // Update Admin-specific fields
        $admin->fill([
            'nom' => $data['nom'] ?? $admin->nom,
            'prenom' => $data['prenom'] ?? $admin->prenom,
            'service' => $data['service'] ?? $admin->service,
        ]);

        // Update User-specific fields
        $user->fill([
            'email' => $data['email'] ?? $user->email,
            'username' => $data['username'] ?? $user->username,
        ]);

        // Set updated by if authenticated
        if (Auth::check()) {
            $admin->updated_by_user_id = Auth::id();
        }

        // Save both models in transaction for data consistency
        DB::transaction(function () use ($admin, $user) {
            $admin->save();
            $user->save();
        });

        // Update role
        foreach ($request->roles as $code) {
            $role = Role::where('code', $code)->first();

            if ($role) {
                UserRole::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'role_id' => $role->id
                    ]
                );
            }
        }

        return response()->json([
            'message' => 'Administrateur mis à jour avec succès.',
        ], 200);
    }

    public function destroy(string $id)
    {
        $admin = Admin::find($id); // Utilisation du modèle Admin

        if (!$admin) {
            return response()->json(['message' => 'Administrateur non trouvé.'], 404);
        }

        try {
            $admin->delete();
             return response()->json(['message' => 'Administrateur supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de l\'administrateur.', 'error' => $e->getMessage()], 500);
        }
    }
}
