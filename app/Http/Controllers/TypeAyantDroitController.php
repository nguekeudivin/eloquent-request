<?php

namespace App\Http\Controllers;

use App\Models\TypeAyantDroit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeAyantDroitController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|unique:type_ayant_droits,libelle',
            'description' => 'nullable|string',
        ]);

        $type = new TypeAyantDroit($validated);
        $type->created_by_user_id = Auth::id();
        $type->save();

        return response()->json([
            'message' => 'Type créé avec succès.',
            'data' => $type,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeAyantDroit $typeAyantDroit)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|unique:type_ayant_droits,libelle,' . $typeAyantDroit->id,
            'description' => 'nullable|string',
        ]);

        $typeAyantDroit->fill($validated);
        $typeAyantDroit->updated_by_user_id = Auth::id();
        $typeAyantDroit->save();

        return response()->json([
            'message' => 'Type mis à jour avec succès.',
            'data' => $typeAyantDroit,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeAyantDroit $typeAyantDroit)
    {
        $id = $typeAyantDroit->id;
        $typeAyantDroit->delete();

        return response()->json([
            'message' => 'Type supprimé avec succès.',
            'id' => $id
        ]);
    }
}
