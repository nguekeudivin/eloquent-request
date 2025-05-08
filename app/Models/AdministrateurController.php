<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdministrateurController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|size:36|exists:users,id|unique:administrateurs,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'service' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $administrateur = new Administrateur();
        $administrateur->id = $validator->validated()['user_id'];
        $administrateur->fill($validator->validated());

        if (Auth::check()) {
             $administrateur->created_by_user_id = Auth::id();
        }

        $administrateur->save();

        return response()->json(['message' => 'Administrateur créé avec succès.', 'data' => $administrateur], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'service' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $administrateur = Administrateur::find($id);

        if (!$administrateur) {
            return response()->json(['message' => 'Administrateur non trouvé.'], 404);
        }

        $administrateur->fill($validator->validated());

         if (Auth::check()) {
            $administrateur->updated_by_user_id = Auth::id();
         }

        $administrateur->save();

        return response()->json(['message' => 'Administrateur mis à jour avec succès.', 'data' => $administrateur], 200);
    }

    public function destroy(string $id)
    {
        $administrateur = Administrateur::find($id);

        if (!$administrateur) {
            return response()->json(['message' => 'Administrateur non trouvé.'], 404);
        }

        try {
            $administrateur->delete();
             return response()->json(['message' => 'Administrateur supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de l\'administrateur.', 'error' => $e->getMessage()], 500);
        }
    }
}
