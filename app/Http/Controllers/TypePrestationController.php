<?php

namespace App\Http\Controllers;

use App\Models\TypePrestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypePrestationController extends Controller
{
    /**
     * Stocker un nouveau type de prestation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|unique:type_prestations,libelle',
        ]);

        $type = new TypePrestation($validated);
        $type->created_by_user_id = Auth::id();
        $type->save();

        return response()->json([
            'message' => 'Type de prestation créé avec succès.',
            'data' => $type,
        ], 201);
    }

    /**
     * Mettre à jour un type de prestation existant.
     */
    public function update(Request $request, TypePrestation $typePrestation)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|unique:type_prestations,libelle,' . $typePrestation->id,
        ]);

        $typePrestation->fill($validated);
        $typePrestation->updated_by_user_id = Auth::id();
        $typePrestation->save();

        return response()->json([
            'message' => 'Type de prestation mis à jour avec succès.',
            'data' => $typePrestation,
        ]);
    }

    /**
     * Supprimer un type de prestation.
     */
    public function destroy(TypePrestation $typePrestation)
    {
        $id = $typePrestation->id;
        $typePrestation->delete();

        return response()->json([
            'message' => 'Type de prestation supprimé avec succès.',
            'id' => $id
        ]);
    }
}
