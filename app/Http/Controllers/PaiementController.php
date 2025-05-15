<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Mutualiste;
use App\Models\User;
use App\Models\Cotisation;
use Illuminate\Support\Carbon;


class PaiementController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'paiement:create'
        $validated = $this->validateWithPermissions($request, [
            'paiement:create' => [
                'mutualiste_id' => ['required', 'uuid', 'exists:users,id'],
                'date_paiement' => ['required', 'date'],
                'montant_recu' => ['required', 'decimal:0,2', 'min:0.01'],
                'mode_paiement' => ['required', 'string', Rule::in(['ESPECES', "VIREMENT BANCAIRE", "MOBILE MONEY", "CHEQUE", "CARTE_BANCAIRE"])],
                'reference_transaction_externe' => ['nullable', 'string', 'max:255'],
                'statut' => ['sometimes', 'required', 'string', Rule::in(['VALIDE', 'EN_ATTENTE', 'ANNULE', 'ECHOUE'])],
                'enregistre_par_utilisateur_id' => ['required', 'uuid', 'exists:users,id'],
            ],
        ]);

         if (!isset($validated['statut'])) {
             $validated['statut'] = 'en attente';
         }

        $paiement = Paiement::create($validated);

        if (Auth::check()) {
             $paiement->update([
                 'created_by_user_id' => Auth::id(),
                 'updated_by_user_id' => Auth::id(),
            ]);
             $paiement->created_by_user_id = Auth::id();
             $paiement->updated_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Paiement enregistré avec succès.', 'data' => $paiement], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'paiement:update'
        try {
             $paiement = Paiement::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Paiement non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'paiement:update' => [
                'mutualiste_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
                'date_paiement' => ['sometimes', 'required', 'date'],
                'montant_recu' => ['sometimes', 'required', 'decimal:0,2', 'min:0.01'],
                'mode_paiement' => ['sometimes', 'required', 'string', Rule::in(['ESPECES', "VIREMENT BANCAIRE", "MOBILE MONEY", "CHEQUE", "CARTE_BANCAIRE"])],
                'reference_transaction_externe' => ['nullable', 'string', 'max:255'],
                 'statut' => ['sometimes', 'required', 'string', Rule::in(['VALIDE', 'EN_ATTENTE', 'ANNULE', 'ECHOUE'])],
                 'enregistre_par_utilisateur_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
            ],
        ]);

        $paiement->fill($validated);

         if (Auth::check()) {
            $paiement->updated_by_user_id = Auth::id();
         }

        $paiement->save();

        return response()->json(['message' => 'Paiement mis à jour avec succès.', 'data' => $paiement], 200);
    }

    public function validatePayment(string $id)
    {
        // Permission: 'paiement:valider'
        try {
             $paiement = Paiement::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Paiement non trouvé.'], 404);
        }

        $success = $paiement->valider();

        if ($success) {
             if (Auth::check()) {
                 $paiement->update(['updated_by_user_id' => Auth::id()]);
                 $paiement->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Paiement validé avec succès.', 'data' => $paiement], 200);
        } else {
             return response()->json(['message' => 'Échec de la validation du Paiement (statut actuel: ' . $paiement->statut . ').'], 409);
        }
    }

    public function applyToCotisations(Request $request, string $id)
    {
        // Permission: 'paiement:appliquer_aux_cotisations'
        try {
             $paiement = Paiement::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Paiement non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'paiement:appliquer_aux_cotisations' => [
                'cotisations' => ['required', 'array'],
                'cotisations.*' => ['decimal:0,2', 'min:0.01', Rule::exists('cotisations', 'id')],
            ],
        ]);

        $success = $paiement->appliquerAuxCotisations($validated['cotisations'], Auth::user());

        if ($success) {
             $paiement->load('cotisations');
             return response()->json(['message' => 'Paiement appliqué aux cotisations avec succès.', 'data' => $paiement], 200);
        } else {
             return response()->json(['message' => 'Échec de l\'application du paiement aux cotisations. Vérifiez le statut du paiement ou les montants appliqués.'], 409);
        }
    }

    public function cancelPayment(string $id)
    {
        // Permission: 'paiement:annuler'
        try {
             $paiement = Paiement::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Paiement non trouvé.'], 404);
        }

         $success = $paiement->annuler();

         if ($success) {
              if (Auth::check()) {
                 $paiement->update(['updated_by_user_id' => Auth::id()]);
                 $paiement->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Paiement annulé avec succès.', 'data' => $paiement], 200);
         } else {
              return response()->json(['message' => 'Échec de l\'annulation du Paiement (statut actuel: ' . $paiement->statut . ').'], 409);
         }
     }

     public function destroy(string $id)
     {
        // Permission: 'paiement:delete'
        try {
             $paiement = Paiement::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Paiement non trouvé.'], 404);
        }

        try {
            $paiement->delete();
             return response()->json(['message' => 'Paiement supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du Paiement.', 'error' => $e->getMessage()], 500);
        }
     }
}
