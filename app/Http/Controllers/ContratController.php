<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\GroupeContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ContratController extends Controller
{
    /**
     * Store a newly created contrat in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|unique:contrats,nom',
            'description' => 'nullable|string',
            'date_debut_validite' => 'required|date',
            'date_fin_validite' => 'nullable|date|after_or_equal:date_debut_validite',
            'montant_cotisation_base' => 'required|min:0',
            'montant_adhesion' => 'required|min:0',
            'periode_cotisation' => ['required', Rule::in(['MENSUEL', 'TRIMESTRIEL', 'ANNUEL'])],
            'groupe_mutualiste_id' => 'exists:groupe_mutualistes,id'
        ]);

        DB::beginTransaction();


        $contrat = Contrat::create([
            'id' => Str::uuid(),
            ...$validated,
            'created_by_user_id' => auth()->id(),
        ]);

        if($request->has('groupe_mutualiste_id')){
            GroupeContrat::create([
                'contrat_id' => $contrat->id,
                'groupe_id' => $request->groupe_mutualiste_id
            ]);
        }

        DB::commit();

        return response()->json(['message' => 'Contrat cree avec success', 'data' => $contrat], 201);
    }

    /**
     * Update the specified contrat in storage.
     */
    public function update(Request $request, string $id)
    {
        $contrat = Contrat::findOrFail($id);

        $validated = $request->validate([
            'nom' => ['required', 'string', Rule::unique('contrats', 'nom')->ignore($contrat->id)],
            'description' => 'nullable|string',
            'date_debut_validite' => 'required|date',
            'date_fin_validite' => 'nullable|date|after_or_equal:date_debut_validite',
            'montant_cotisation_base' => 'numeric|min:0',
            'montant_adhesion' => 'numeric|min:0',
            'periode_cotisation' => [Rule::in(['MENSUEL', 'TRIMESTRIEL', 'ANNUEL'])],
            'est_actif' => 'boolean',
        ]);

        $contrat->update([
            ...$validated,
            'updated_by_user_id' => auth()->id(),
        ]);

        return response()->json(['message' => "Contrat modifier avec success", 'data' => $contrat]);
    }

    /**
     * Remove the specified contrat from storage.
     */
    public function destroy(string $id)
    {
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();

        return response()->json(['message' => 'Contrat supprimé avec succès.', 'id' => $id]);
    }
}
