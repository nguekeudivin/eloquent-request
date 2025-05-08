<?php

namespace App\Http\Controllers;

use App\Models\Mutualiste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Pour valider l'ENUM sexe

class MutualisteController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|size:36|exists:users,id|unique:mutualistes,id',
            'numero_adherent' => 'required|string|max:255|unique:mutualistes,numero_adherent',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'sexe' => ['nullable', Rule::in(['H', 'F', 'Autre'])], // Validation de l'ENUM
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'statut_social' => 'nullable|string|max:255',
            'date_premiere_adhesion' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mutualiste = new Mutualiste();
        $mutualiste->id = $validator->validated()['user_id'];
        $mutualiste->fill($validator->validated());

        if (Auth::check()) {
             $mutualiste->created_by_user_id = Auth::id();
        }

        $mutualiste->save();

        return response()->json(['message' => 'Mutualiste créé avec succès.', 'data' => $mutualiste], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'numero_adherent' => 'string|max:255|unique:mutualistes,numero_adherent,' . $id,
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'date_naissance' => 'date',
            'lieu_naissance' => 'nullable|string|max:255',
            'sexe' => ['nullable', Rule::in(['H', 'F', 'Autre'])],
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'statut_social' => 'nullable|string|max:255',
            'date_premiere_adhesion' => 'date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mutualiste = Mutualiste::find($id);

        if (!$mutualiste) {
            return response()->json(['message' => 'Mutualiste non trouvé.'], 404);
        }

        $mutualiste->fill($validator->validated());

         if (Auth::check()) {
            $mutualiste->updated_by_user_id = Auth::id();
         }

        $mutualiste->save();

        return response()->json(['message' => 'Mutualiste mis à jour avec succès.', 'data' => $mutualiste], 200);
    }

    public function destroy(string $id)
    {
        $mutualiste = Mutualiste::find($id);

        if (!$mutualiste) {
            return response()->json(['message' => 'Mutualiste non trouvé.'], 404);
        }

        try {
            $mutualiste->delete();
             return response()->json(['message' => 'Mutualiste supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du mutualiste.', 'error' => $e->getMessage()], 500);
        }
    }
}
