<?php

namespace App\Http\Controllers;

use App\Models\StatusType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class StatusTypeController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_interne' => 'required|string|max:50|unique:status_types,code_interne',
            'libelle' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'contexte' => 'required|string|max:100',
            'couleur_hex' => 'nullable|string|max:7',
            'ordre_affichage' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $StatusType = new StatusType();
        $StatusType->fill($validator->validated());

        // if (Auth::check()) {
        //      $StatusType->created_by_user_id = Auth::id();
        // }

        $StatusType->save();

        return response()->json(['message' => 'Type de statut créé avec succès.', 'data' => $StatusType], 201);
    }


    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'code_interne' => 'string|max:50|unique:status_types,code_interne,' . $id,
            'libelle' => 'string|max:100',
            'description' => 'nullable|string|max:255',
            'contexte' => 'string|max:100',
            'couleur_hex' => 'nullable|string|max:7',
            'ordre_affichage' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $StatusType = StatusType::find($id);

        if (!$StatusType) {
            return response()->json(['message' => 'Type de statut non trouvé.'], 404);
        }

        $StatusType->fill($validator->validated());

         if (Auth::check()) {
             $StatusType->updated_by_user_id = Auth::id();
         }

        $StatusType->save();

        return response()->json(['message' => 'Type de statut mis à jour avec succès.', 'data' => $StatusType], 200);
    }

    public function destroy(string $id)
    {
        $StatusType = StatusType::find($id);

        if (!$StatusType) {
            return response()->json(['message' => 'Type de statut non trouvé.'], 404);
        }

        try {
            $StatusType->delete();
             return response()->json(['message' => 'Type de statut supprimé avec succès.'], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du type de statut.', 'error' => $e->getMessage()], 500);
        }
    }
}
