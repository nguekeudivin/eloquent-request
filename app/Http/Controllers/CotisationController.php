<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Adhesion; // Pour validation exists
use Illuminate\Support\Carbon;


class CotisationController extends Controller
{
    use PermissionValidator;

    // Opération 'generer(adhesionId, periode, montant, dateLimite)' -> store (simplifié ici)
    // Note: La logique de génération complète est souvent dans Adhesion::genererCotisations()
    public function store(Request $request)
    {
        // Permission: 'cotisation:create' (+ attributs)
        // e.g., Auth::user()->can('cotisation:create')

        $validated = $this->validateWithPermissions($request, [
            'cotisation:create' => [ // Permission pattern prefix
                'adhesion_id' => ['required', 'uuid', 'exists:adhesions,id'],
                'periode_concerne' => ['required', 'string', 'max:255'],
                'montant_prevu' => ['required', 'decimal:0,2', 'min:0'],
                'date_limite_paiement' => ['required', 'date'],
                // montant_paye, date_paiement_effective, statut, reference_externe sont optionnels à la création
                 'montant_paye' => ['sometimes', 'decimal:0,2', 'min:0'], // Peut être spécifié si paiement initial
                 'date_paiement_effective' => ['nullable', 'date', 'after_or_equal:date_limite_paiement'],
                //  'statut' => ['sometimes', 'required', 'string', Rule::in(['due', 'payée', 'partielle', 'en retard', 'annulée'])],
                 'reference_externe' => ['nullable', 'string', 'max:255'],
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
       }

        // Si le statut n'est pas fourni, le définir par défaut (due, partielle, payée) basé sur montant_paye
         if (!isset($validated['statut'])) {
             if (isset($validated['montant_paye']) && $validated['montant_paye'] >= $validated['montant_prevu']) {
                 $validated['statut'] = 'payée';
                 if (!isset($validated['date_paiement_effective'])) {
                     $validated['date_paiement_effective'] = now(); // Définir la date si payée et non spécifiée
                 }
             } elseif (isset($validated['montant_paye']) && $validated['montant_paye'] > 0) {
                 $validated['statut'] = 'partielle';
             } else {
                 $validated['statut'] = 'due';
             }
         }


        $cotisation = Cotisation::create($validated);
        $cotisation->adhesion->mutualiste;

        if (Auth::check()) {
             $cotisation->update(['created_by_user_id' => Auth::id()]);
             $cotisation->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Cotisation créée avec succès.', 'data' => $cotisation], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'cotisation:update' (+ attributs)
        // e.g., Auth::user()->can('cotisation:update') and Auth::user()->can('update', $cotisation) Policy check

        try {
             $cotisation = Cotisation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Cotisation non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'cotisation:update' => [ // Permission pattern prefix
                'adhesion_id' => ['sometimes', 'required', 'uuid', 'exists:adhesions,id'],
                'periode_concerne' => ['sometimes', 'required', 'string', 'max:255'],
                'montant_prevu' => ['sometimes', 'required', 'decimal:0,2', 'min:0'],
                 // montant_paye est généralement mis à jour via appliquerPaiement, mais peut être permis ici
                 'montant_paye' => ['sometimes', 'decimal:0,2', 'min:0'],
                'date_limite_paiement' => ['sometimes', 'required', 'date'],
                'date_paiement_effective' => ['nullable', 'date', 'after_or_equal:date_limite_paiement'],
                'statut' => ['sometimes', 'required', 'string', Rule::in(['due', 'payée', 'partielle', 'en retard', 'annulée'])],
                'reference_externe' => ['nullable', 'string', 'max:255'],
            ],
        ]);

        $cotisation->fill($validated);

         if (Auth::check()) {
            $cotisation->updated_by_user_id = Auth::id();
         }

        $cotisation->save();

        return response()->json(['message' => 'Cotisation mise à jour avec succès.', 'data' => $cotisation], 200);
    }

     // Opération 'appliquerPaiement(montant)' -> custom method 'applyPayment'
     // Permission: 'cotisation:appliquer_paiement' (+ Policy)
    public function applyPayment(Request $request, string $id)
    {
        // Permission check for applyPayment operation
        // e.g., Auth::user()->can('cotisation:appliquer_paiement') and Auth::user()->can('appliquerPaiement', $cotisation) Policy check

        try {
             $cotisation = Cotisation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Cotisation non trouvée.'], 404);
        }

        // Validation spécifique pour l'application de paiement
        $validated = $this->validateWithPermissions($request, [
            'cotisation:appliquer_paiement' => [
                'montant' => ['required', 'decimal:0,2', 'min:0.01'], // Montant positif requis
            ],
        ]);

        // Utilise la méthode du modèle pour appliquer le paiement
        $success = $cotisation->appliquerPaiement($validated['montant']);

        if ($success) {
             // Optionnel : Mettre à jour updated_by_user_id après la méthode du modèle
             if (Auth::check()) {
                 $cotisation->update(['updated_by_user_id' => Auth::id()]);
                 $cotisation->updated_by_user_id = Auth::id(); // Mettre à jour l'instance en mémoire
             }
             return response()->json(['message' => 'Paiement appliqué avec succès.', 'data' => $cotisation], 200);
        } else {
             return response()->json(['message' => 'Échec de l\'application du paiement.'], 500);
        }
    }

    // Opération 'marquerPayee()' -> custom method 'markAsPaid'
     // Permission: 'cotisation:marquer_payee' (+ Policy)
     public function markAsPaid(string $id)
     {
         // Permission check for markAsPaid operation
         // e.g., Auth::user()->can('cotisation:marquer_payee') and Auth::user()->can('marquerPayee', $cotisation) Policy check

         try {
              $cotisation = Cotisation::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Cotisation non trouvée.'], 404);
         }

         // Utilise la méthode du modèle
         $success = $cotisation->marquerPayee();

         if ($success) {
              if (Auth::check()) {
                 $cotisation->update(['updated_by_user_id' => Auth::id()]);
                 $cotisation->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Cotisation marquée comme payée.', 'data' => $cotisation], 200);
         } else {
              return response()->json(['message' => 'Échec de la mise à jour du statut "payée".'], 500);
         }
     }

     // Opération 'marquerEnRetard()' -> custom method 'markAsOverdue'
     // Permission: 'cotisation:marquer_EN RETARD' (+ Policy)
     // Note: Cette méthode est souvent déclenchée par une tâche planifiée, pas une API directe
     public function markAsOverdue(string $id)
     {
         // Permission check for markAsOverdue operation
         // e.g., Auth::user()->can('cotisation:marquer_EN RETARD') and Auth::user()->can('marquerEnRetard', $cotisation) Policy check

         try {
              $cotisation = Cotisation::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Cotisation non trouvée.'], 404);
         }

         // Utilise la méthode du modèle
         $success = $cotisation->marquerEnRetard();

         if ($success) {
              if (Auth::check()) {
                 $cotisation->update(['updated_by_user_id' => Auth::id()]);
                 $cotisation->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Cotisation marquée comme en retard.', 'data' => $cotisation], 200);
         } else {
              return response()->json(['message' => 'Échec de la mise à jour du statut "en retard".'], 500);
         }
     }

     // Opération 'annuler()' -> custom method 'cancel'
     // Permission: 'cotisation:annuler' (+ Policy)
     public function cancel(string $id)
     {
         // Permission check for cancel operation
         // e.g., Auth::user()->can('cotisation:annuler') and Auth::user()->can('annuler', $cotisation) Policy check

         try {
              $cotisation = Cotisation::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Cotisation non trouvée.'], 404);
         }

         // Utilise la méthode du modèle
         $success = $cotisation->annuler();

         if ($success) {
              if (Auth::check()) {
                 $cotisation->update(['updated_by_user_id' => Auth::id()]);
                 $cotisation->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Cotisation annulée avec succès.', 'data' => $cotisation], 200);
         } else {
              return response()->json(['message' => 'Échec de l\'annulation de la Cotisation.'], 500);
         }
     }


     // Opération implicite 'supprimer()' -> destroy (standard DELETE HTTP)
     // Permission: 'cotisation:delete' (+ Policy)
     public function destroy(string $id)
     {
         // Permission check for deleting a cotisation
        // e.g., Auth::user()->can('cotisation:delete') and Auth::user()->can('delete', $cotisation) Policy check

        try {
             $cotisation = Cotisation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Cotisation non trouvée.'], 404);
        }

        try {
            $cotisation->delete();
             return response()->json(['message' => 'Cotisation supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la Cotisation.', 'error' => $e->getMessage()], 500);
        }
     }
}
