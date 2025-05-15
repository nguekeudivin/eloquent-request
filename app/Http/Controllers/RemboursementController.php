<?php

namespace App\Http\Controllers;

use App\Models\Remboursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\PriseEnCharge;
use App\Models\User;
use App\Models\ModaliteRemboursement;
use Illuminate\Support\Carbon;


class RemboursementController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'remboursement:create'
        $validated = $this->validateWithPermissions($request, [
            'remboursement:create' => [
                'prise_en_charge_id' => [
                    'required',
                    'uuid',
                    Rule::exists('prise_en_charges', 'id')->where(function ($query) {
                         $query->where('statut', 'validée');
                         $query->doesntHave('remboursement');
                    })
                ],
                'modalite_remboursement_id' => ['required', 'integer', 'exists:modalite_remboursements,id'],
                'date_paiement' => ['required', 'date', 'before_or_equal:today'],
                'montant_paye' => ['required', 'decimal:0,2', 'min:0.01'],
                'mode_paiement' => ['required', 'string', Rule::in(['VIREMENT BANCAIRE', 'CHEQUE', 'ESPECES CAISSE']
                )],
                'reference_transaction' => ['nullable', 'string', 'max:255'],
                'paye_par_admin_id' => ['required', 'uuid', 'exists:users,id'],
            ],
        ]);

        $priseEnCharge = PriseEnCharge::find($validated['prise_en_charge_id']);
        if ($priseEnCharge && $validated['montant_paye'] != $priseEnCharge->montant_pris_en_charge) {
             $validated['montant_paye'] = $priseEnCharge->montant_pris_en_charge;
        }

        $remboursement = Remboursement::create($validated);

        if (Auth::check()) {
             $remboursement->update([
                 'created_by_user_id' => Auth::id(),
                 'updated_by_user_id' => Auth::id(),
            ]);
             $remboursement->created_by_user_id = Auth::id();
             $remboursement->updated_by_user_id = Auth::id();
        }

        if ($priseEnCharge) {
             $priseEnCharge->marquerRemboursee();
        }

        return response()->json(['message' => 'Remboursement enregistré avec succès.', 'data' => $remboursement], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'remboursement:update'
        try {
             $remboursement = Remboursement::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Remboursement non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'remboursement:update' => [
                 'prise_en_charge_id' => [
                     'sometimes',
                     'required',
                     'uuid',
                     Rule::exists('prise_en_charges', 'id')->where(function ($query) use ($remboursement) {
                          $query->where('statut', 'validée');
                          $query->doesntHave('remboursement');
                     })->ignore($remboursement->prise_en_charge_id, 'prise_en_charge_id')
                 ],
                 'modalite_remboursement_id' => ['sometimes', 'required', 'integer', 'exists:modalite_remboursements,id'],
                'date_paiement' => ['sometimes', 'required', 'date', 'before_or_equal:today'],
                'montant_paye' => ['sometimes', 'required', 'decimal:0,2', 'min:0.01'],
                'mode_paiement' => ['sometimes', 'required', 'string', Rule::in(['VIREMENT BANCAIRE', 'CHEQUE', 'ESPECES CAISSE']
                )],
                'reference_transaction' => ['nullable', 'string', 'max:255'],
                'paye_par_admin_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
            ],
        ]);

         if (isset($validated['montant_paye']) || (isset($validated['prise_en_charge_id']) && $validated['prise_en_charge_id'] !== $remboursement->prise_en_charge_id)) {
             $targetPriseEnChargeId = $validated['prise_en_charge_id'] ?? $remboursement->prise_en_charge_id;
             $targetPriseEnCharge = PriseEnCharge::find($targetPriseEnChargeId);
             if ($targetPriseEnCharge && isset($validated['montant_paye']) && $validated['montant_paye'] != $targetPriseEnCharge->montant_pris_en_charge) {
                  $validated['montant_paye'] = $targetPriseEnCharge->montant_pris_en_charge;
             }
         }

        $remboursement->fill($validated);

         if (Auth::check()) {
            $remboursement->updated_by_user_id = Auth::id();
         }

        $remboursement->save();

        return response()->json(['message' => 'Remboursement mis à jour avec succès.', 'data' => $remboursement], 200);
    }

     public function destroy(string $id)
     {
        // Permission: 'remboursement:delete'
        try {
             $remboursement = Remboursement::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Remboursement non trouvé.'], 404);
        }

        $priseEnCharge = $remboursement->priseEnCharge;
        if ($priseEnCharge && $priseEnCharge->statut === 'remboursée') {
             // $priseEnCharge->statut = 'validée';
             // $priseEnCharge->save();
        }

        try {
            $remboursement->delete();
             return response()->json(['message' => 'Remboursement supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du Remboursement.', 'error' => $e->getMessage()], 500);
        }
     }
}
