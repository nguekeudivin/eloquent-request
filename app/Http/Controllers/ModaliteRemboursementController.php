<?php

namespace App\Http\Controllers;

use App\Models\ModaliteRemboursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModaliteRemboursementController extends Controller
{
    /**
     * Stocker une nouvelle modalité de remboursement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_prestation_id' => 'required|exists:type_prestations,id',
            'type_ayant_droit_id' => 'required|exists:type_ayant_droits,id',
            'taux_hopital_public' => 'required|numeric|min:0|max:100',
            'taux_hopital_prive' => 'required|numeric|min:0|max:100',
        ]);

        // Vérifier l'unicité manuellement en cas d'erreur de DB
        if (ModaliteRemboursement::where('type_prestation_id', $validated['type_prestation_id'])
            ->where('type_ayant_droit_id', $validated['type_ayant_droit_id'])->exists()) {
            return response()->json(['message' => 'Cette combinaison existe déjà.'], 422);
        }

        $modalite = new ModaliteRemboursement($validated);
        $modalite->created_by_user_id = Auth::id();
        $modalite->save();

        return response()->json([
            'message' => 'Modalité créée avec succès.',
            'data' => $modalite,
        ], 201);
    }

    /**
     * Mettre à jour une modalité de remboursement.
     */
    public function update(Request $request, ModaliteRemboursement $modaliteRemboursement)
    {
        $validated = $request->validate([
            'taux_hopital_public' => 'required|numeric|min:0|max:100',
            'taux_hopital_prive' => 'required|numeric|min:0|max:100',
        ]);

        $modaliteRemboursement->fill($validated);
        $modaliteRemboursement->updated_by_user_id = Auth::id();
        $modaliteRemboursement->save();

        $modaliteRemboursement->type_prestation;
        $modaliteRemboursement->type_ayant_droit;

        return response()->json([
            'message' => 'Modalité mise à jour avec succès.',
            'data' => $modaliteRemboursement,
        ]);
    }

    /**
     * Supprimer une modalité.
     */
    public function destroy(ModaliteRemboursement $modaliteRemboursement)
    {
        $id = $modaliteRemboursement->id;
        $modaliteRemboursement->delete();

        return response()->json([
            'message' => 'Modalité supprimée avec succès.',
            'id' => $id
        ]);
    }
}
