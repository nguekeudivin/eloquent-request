<?php

namespace App\Http\Controllers;

use App\Models\TypeStatut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TypeStatutController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_interne' => 'required|string|max:50|unique:type_statuts,code_interne',
            'libelle' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'contexte' => 'required|string|max:100',
            'couleur_hex' => 'nullable|string|max:7',
            'ordre_affichage' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $typeStatut = new TypeStatut();
        $typeStatut->fill($validator->validated());

        // if (Auth::check()) {
        //      $typeStatut->created_by_user_id = Auth::id();
        // }

        $typeStatut->save();

        return response()->json(['message' => 'Type de statut créé avec succès.', 'data' => $typeStatut], 201);
    }


    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'code_interne' => 'string|max:50|unique:type_statuts,code_interne,' . $id,
            'libelle' => 'string|max:100',
            'description' => 'nullable|string|max:255',
            'contexte' => 'string|max:100',
            'couleur_hex' => 'nullable|string|max:7',
            'ordre_affichage' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $typeStatut = TypeStatut::find($id);

        if (!$typeStatut) {
            return response()->json(['message' => 'Type de statut non trouvé.'], 404);
        }

        $typeStatut->fill($validator->validated());

         if (Auth::check()) {
             $typeStatut->updated_by_user_id = Auth::id();
         }

        $typeStatut->save();

        return response()->json(['message' => 'Type de statut mis à jour avec succès.', 'data' => $typeStatut], 200);
    }

    public function destroy(string $id)
    {
        $typeStatut = TypeStatut::find($id);

        if (!$typeStatut) {
            return response()->json(['message' => 'Type de statut non trouvé.'], 404);
        }

        try {
            $typeStatut->delete();
             return response()->json(['message' => 'Type de statut supprimé avec succès.'], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du type de statut.', 'error' => $e->getMessage()], 500);
        }
    }
}
