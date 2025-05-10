<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon; // Pour date_attribution

class AdminRoleController extends Controller
{
    // Attacher un rôle à un administrateur
    // POST /api/administrateurs/{adminId}/roles
    public function attachRole(Request $request, string $adminId)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|string|size:36|exists:roles,id',
            'date_attribution' => 'nullable|date', // Peut être fourni ou utiliser la date actuelle
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $administrateur = Administrateur::find($adminId);

        if (!$administrateur) {
            return response()->json(['message' => 'Administrateur non trouvé.'], 404);
        }

        $roleId = $validator->validated()['role_id'];
        $dateAttribution = $validator->validated()['date_attribution'] ?? Carbon::now(); // Utilise la date actuelle si non fournie

        // Données supplémentaires pour la table pivot
        $pivotData = [
            'date_attribution' => $dateAttribution,
        ];

        if (Auth::check()) {
            $pivotData['created_by_user_id'] = Auth::id();
            // updated_by_user_id sera null à l'attachement initial
        }

        // Vérifier si le rôle n'est pas déjà attaché pour éviter une erreur de clé primaire
         if ($administrateur->roles()->where('role_id', $roleId)->exists()) {
             return response()->json(['message' => 'Ce rôle est déjà attribué à cet administrateur.'], 409);
         }

        // Attacher le rôle à l'administrateur avec les données pivot
        $administrateur->roles()->attach($roleId, $pivotData);

        return response()->json(['message' => 'Rôle attribué avec succès.'], 200);
    }

    // Détacher un rôle d'un administrateur
    // DELETE /api/administrateurs/{adminId}/roles/{roleId}
    public function detachRole(string $adminId, string $roleId)
    {
        $administrateur = Administrateur::find($adminId);

        if (!$administrateur) {
            return response()->json(['message' => 'Administrateur non trouvé.'], 404);
        }

        $role = Role::find($roleId);

        if (!$role) {
             return response()->json(['message' => 'Rôle non trouvé.'], 404);
        }

        // Détacher le rôle de l'administrateur
        $detached = $administrateur->roles()->detach($roleId);

        if ($detached) {
            return response()->json(['message' => 'Rôle retiré avec succès.'], 200);
        } else {
            // Si 0 ligne a été affectée par le detach, c'est que la combinaison n'existait pas
             return response()->json(['message' => 'Cette attribution de rôle n\'existe pas pour cet administrateur.'], 404);
        }
    }

    // Vous pouvez aussi ajouter des méthodes pour lister les rôles d'un admin, sync, etc.
    // Lister les rôles d'un administrateur
    // GET /api/administrateurs/{adminId}/roles
     public function listRoles(string $adminId)
     {
         $administrateur = Administrateur::find($adminId);

         if (!$administrateur) {
             return response()->json(['message' => 'Administrateur non trouvé.'], 404);
         }

         // Charger les rôles avec les données pivot (date_attribution, timestamps, audit users)
         $roles = $administrateur->roles()->withPivot('date_attribution', 'created_at', 'updated_at', 'created_by_user_id', 'updated_by_user_id')->get();

         return response()->json(['administrateur_id' => $adminId, 'roles' => $roles], 200);
     }
}
