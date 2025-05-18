<?php

namespace App\Http\Controllers;

use App\Models\PriseEnCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Mutualiste;
use App\Models\AyantDroit;
use App\Models\Prestation;
use App\Models\Adhesion;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str; // Pour générer la référence


class PriseEnChargeController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'prise_en_charge:create' => [ // Permission pattern prefix
                'date_soins_facture' => ['required', 'date', 'before_or_equal:today'], // Date des soins/facture ne peut pas être future
                'mutualiste_id' => ['required', 'uuid', 'exists:users,id'],
                'ayant_droit_id' => [
                    'nullable',
                    'uuid',
                    Rule::exists('ayant_droits', 'id')->where(function ($query) use ($request) {
                        return $query->where('mutualiste_id', $request->mutualiste_id);
                    })
                ],
                'type_prestation_id' => ['required', 'integer', 'exists:type_prestations,id'],
                'hopital' => ['required', Rule::in(['PUBLIC',"PRIVE"])],
                // adhesion_id doit exister dans la table adhesions ET être lié au mutualiste_id fourni ET être active à la date des soins
                'adhesion_id' => [
                    'required',
                    'uuid',
                    Rule::exists('adhesions', 'id')->where(function ($query) use ($request) {
                        // Vérifier que l'adhésion appartient au mutualiste
                        $query->where('mutualiste_id', $request->mutualiste_id);
                        // Vérifier que l'adhésion était active à la date des soins/facture
                        // date_debut <= date_soins_facture ET (date_fin IS NULL OR date_fin >= date_soins_facture)
                        $query->where('date_debut', '<=', $request->date_soins_facture)
                              ->where(function ($query) use ($request) {
                                  $query->whereNull('date_fin')
                                        ->orWhere('date_fin', '>=', $request->date_soins_facture);
                              });
                         // Optionnel : vérifier le statut de l'adhésion ('actif') si pertinent
                         // $query->where('statut', 'actif');
                    })
                ],
                'montant_facture' => ['required', 'decimal:0,2', 'min:0.01'],
                 'montant_pris_en_charge' => ['nullable', 'decimal:0,2', 'min:0'],
                 'statut' => ['sometimes', 'required', 'string', Rule::in(['SOUMISE', 'EN COURS', 'VALIDEE', 'REMBOURSEE', 'REFUSEE', 'ANNULEE'])],
                 'description' => ['nullable', 'string'],

            ],
        ]);

        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }


        // Définir la référence unique si non fournie
         if (!isset($validated['reference'])) {
             $validated['reference'] = 'PEC-' . Str::random(8); // Générer une référence unique
         } else {
             // Si fournie, valider son unicité (peut être ajouté à la validation ci-dessus)
             $request->validate(['reference' => 'unique:prise_en_charges,reference']);
         }


        // Définir le statut par défaut à 'soumise' si non spécifié
         if (!isset($validated['statut'])) {
             $validated['statut'] = 'SOUMISE';
         }

        // Définir les dates de soumission et mise à jour du statut à maintenant
        $validated['date_soumission'] = now();
        $validated['date_mise_a_jour_statut'] = now();
        $validated['soumise_par_user_id'] = $request->user()->id;

        // Créer la prise en charge
        $priseEnCharge = PriseEnCharge::create($validated);

        // Définir les champs created_by_user_id et updated_by_user_id
        if (Auth::check()) {
             $priseEnCharge->update([
                 'created_by_user_id' => Auth::id(),
                 'updated_by_user_id' => Auth::id(),
            ]);
             $priseEnCharge->created_by_user_id = Auth::id();
             $priseEnCharge->updated_by_user_id = Auth::id();
        } else {
             // Gérer le cas où aucun utilisateur n'est authentifié
        }

        $priseEnCharge->load('mutualiste','ayant_droit','type_prestation');

        return response()->json(['message' => 'Demande de prise en charge créée avec succès.', 'data' => $priseEnCharge], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'prise_en_charge:update'
        // e.g., Auth::user()->can('prise_en_charge:update') and Auth::user()->can('update', $priseEnCharge) Policy check

        try {
             $priseEnCharge = PriseEnCharge::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Demande de prise en charge non trouvée.'], 404);
        }

        // Note: La mise à jour directe de certains champs (ex: mutualiste_id, prestation_id, adhesion_id)
        // peut être restreinte selon les règles métier ou les permissions, surtout si la demande est déjà traitée.
        $validated = $this->validateWithPermissions($request, [
            'prise_en_charge:update' => [ // Permission pattern prefix
                'reference' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('prise_en_charges', 'reference')->ignore($priseEnCharge->id)],
                'date_soins_facture' => ['sometimes', 'required', 'date', 'before_or_equal:today'],
                'mutualiste_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
                'ayant_droit_id' => [
                    'sometimes',
                    'nullable',
                    'uuid',
                    Rule::exists('ayant_droits', 'id')->where(function ($query) use ($request, $priseEnCharge) {
                        $mutualisteId = $request->has('mutualiste_id') ? $request->mutualiste_id : $priseEnCharge->mutualiste_id;
                        return $query->where('mutualiste_id', $mutualisteId);
                    })
                ],
                'adhesion_id' => [
                    'sometimes',
                    'required',
                    'uuid',
                    Rule::exists('adhesions', 'id')->where(function ($query) use ($request, $priseEnCharge) {
                        $mutualisteId = $request->has('mutualiste_id') ? $request->mutualiste_id : $priseEnCharge->mutualiste_id;
                        $dateSoins = $request->has('date_soins_facture') ? $request->date_soins_facture : $priseEnCharge->date_soins_facture;

                        $query->where('mutualiste_id', $mutualisteId);
                        $query->where('date_debut', '<=', $dateSoins)
                              ->where(function ($query) use ($dateSoins) {
                                  $query->whereNull('date_fin')
                                        ->orWhere('date_fin', '>=', $dateSoins);
                              });
                    })
                ],
                'type_prestation_id' => ['sometimes', 'required', 'integer', 'exists:type_prestations,id'],
                 // Validation de l'adhésion à la mise à jour si mutualiste_id ou adhesion_id est modifié
                'montant_facture' => ['sometimes', 'required', 'decimal:0,2', 'min:0.01'],
                 // montant_pris_en_charge peut être mis à jour via update si permis (mais souvent via valider)
                 'montant_pris_en_charge' => ['nullable', 'decimal:0,2', 'min:0'],
                 // Statut peut être mis à jour via update si permis (mais souvent via méthodes spécifiques)
                 'statut' => ['sometimes', 'required', 'string', Rule::in(['SOUMISE', 'EN COURS', 'VALIDEE', 'REMBOURSEE', 'REFUSEE', 'ANNULEE'])],
                 'description' => ['nullable', 'string'],
                 // soumise_par_user_id ne devrait généralement pas être mis à jour
                 // validee_par_admin_id peut être mis à jour via update si permis (mais souvent via valider/refuser)
                 'validee_par_admin_id' => ['nullable', 'uuid', 'exists:users,id'],
            ],
        ]);

        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }



        // Si le statut est mis à jour via cette méthode, mettre à jour date_mise_a_jour_statut
         if (isset($validated['statut']) && $validated['statut'] !== $priseEnCharge->statut) {
             $validated['date_mise_a_jour_statut'] = now();
         }

        $priseEnCharge->fill($validated);

         if (Auth::check()) {
            $priseEnCharge->updated_by_user_id = Auth::id();
         }

        $priseEnCharge->save();

        $priseEnCharge->load('mutualiste','ayant_droit','type_prestation');

        return response()->json(['message' => 'Demande de prise en charge mise à jour avec succès.', 'data' => $priseEnCharge], 200);
    }

     // Opération implicite 'supprimer()' -> destroy (standard DELETE HTTP)
     // Permission: 'prise_en_charge:delete'
     public function destroy(string $id)
     {
         // Permission check for deleting a prise_en_charge
        // e.g., Auth::user()->can('prise_en_charge:delete') and Auth::user()->can('delete', $priseEnCharge) Policy check

        try {
             $priseEnCharge = PriseEnCharge::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Demande de prise en charge non trouvée.'], 404);
        }

        try {
            $priseEnCharge->delete();
             return response()->json(['message' => 'Demande de prise en charge supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la demande de prise en charge.', 'error' => $e->getMessage()], 500);
        }
     }

    // Méthode 'valider(adminId, montantPrisEnCharge)' -> custom method 'validatePriseEnCharge'
    // Permission: 'prise_en_charge:valider'
    public function validatePriseEnCharge(Request $request, string $id)
    {
        // Permission check for validatePriseEnCharge operation
        // e.g., Auth::user()->can('prise_en_charge:valider') and Auth::user()->can('valider', $priseEnCharge) Policy check

        try {
             $priseEnCharge = PriseEnCharge::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Demande de prise en charge non trouvée.'], 404);
        }

        // Validation spécifique pour la validation
        $validated = $this->validateWithPermissions($request, [
            'prise_en_charge:valider' => [
                'montant_pris_en_charge' => ['required', 'decimal:0,2', 'min:0', 'lte:' . $priseEnCharge->montant_facture], // Montant pris en charge <= montant facture
            ],
        ]);

        // Utilise la méthode du modèle pour valider
        // Passe l'ID de l'utilisateur authentifié s'il existe
        $adminId = Auth::id(); // L'admin validateur est l'utilisateur authentifié
        if (!$adminId) {
             return response()->json(['message' => 'Utilisateur authentifié requis pour valider.'], 401); // Unauthorized
        }

        $success = $priseEnCharge->valider($adminId, $validated['montant_pris_en_charge']);

        if ($success) {
             // updated_by_user_id est déjà mis à jour par la méthode du modèle si elle appelle save()
             if (Auth::check()) {
                 $priseEnCharge->update(['updated_by_user_id' => Auth::id()]);
                 $priseEnCharge->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Demande de prise en charge validée avec succès.', 'data' => $priseEnCharge], 200);
        } else {
             return response()->json(['message' => 'Échec de la validation de la demande de prise en charge (statut actuel: ' . $priseEnCharge->statut . ').'], 409); // 409 Conflict si statut non compatible
        }
    }

     // Méthode 'refuser(adminId, motif)' -> custom method 'refusePriseEnCharge'
     // Permission: 'prise_en_charge:refuser'
     public function refusePriseEnCharge(Request $request, string $id)
     {
         // Permission check for refusePriseEnCharge operation
         // e.g., Auth::user()->can('prise_en_charge:refuser') and Auth::user()->can('refuser', $priseEnCharge) Policy check

         try {
              $priseEnCharge = PriseEnCharge::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Demande de prise en charge non trouvée.'], 404);
         }

         // Validation spécifique pour le motif de refus
         $validated = $this->validateWithPermissions($request, [
             'prise_en_charge:refuser' => [
                 'motif' => ['nullable', 'string'], // Motif de refus optionnel
             ],
         ]);

         $adminId = Auth::id(); // L'admin qui refuse est l'utilisateur authentifié
         if (!$adminId) {
              return response()->json(['message' => 'Utilisateur authentifié requis pour refuser.'], 401); // Unauthorized
         }

         // Utilise la méthode du modèle pour refuser
         // Passe l'ID de l'admin et le motif de refus validé
         $success = $priseEnCharge->refuser($adminId, $validated['motif'] ?? null);

         if ($success) {
              if (Auth::check()) {
                 $priseEnCharge->update(['updated_by_user_id' => Auth::id()]);
                 $priseEnCharge->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Demande de prise en charge refusée avec succès.', 'data' => $priseEnCharge], 200);
         } else {
              return response()->json(['message' => 'Échec du refus de la demande de prise en charge (statut actuel: ' . $priseEnCharge->statut . ').'], 409); // 409 Conflict si statut non compatible
         }
     }

     // Méthode 'marquerRemboursee()' -> custom method 'markAsRemboursee'
     // Permission: 'prise_en_charge:marquer_remboursee'
     public function markAsRemboursee(string $id)
     {
         // Permission check for markAsRemboursee operation
         // e.g., Auth::user()->can('prise_en_charge:marquer_remboursee') and Auth::user()->can('marquerRemboursee', $priseEnCharge) Policy check

         try {
              $priseEnCharge = PriseEnCharge::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Demande de prise en charge non trouvée.'], 404);
         }

          // Utilise la méthode du modèle
          $success = $priseEnCharge->marquerRemboursee();

          if ($success) {
               if (Auth::check()) {
                  $priseEnCharge->update(['updated_by_user_id' => Auth::id()]);
                  $priseEnCharge->updated_by_user_id = Auth::id();
              }
              return response()->json(['message' => 'Demande de prise en charge marquée comme remboursée.', 'data' => $priseEnCharge], 200);
          } else {
               return response()->json(['message' => 'Échec de la mise à jour du statut "remboursée" (statut actuel: ' . $priseEnCharge->statut . ').'], 409); // 409 Conflict si statut non compatible
          }
     }

      // Méthode 'associerJustificatif(documentId)' -> custom method 'attachJustificatif'
      // Permission: 'prise_en_charge:associer_justificatif'
      // Nécessite une relation ou une table pivot pour les documents
      public function attachJustificatif(Request $request, string $id)
      {
          // Permission check for attachJustificatif operation
          // e.g., Auth::user()->can('prise_en_charge:associer_justificatif') and Auth::user()->can('associerJustificatif', $priseEnCharge) Policy check

          try {
               $priseEnCharge = PriseEnCharge::findOrFail($id);
          } catch (ModelNotFoundException $e) {
               return response()->json(['message' => 'Demande de prise en charge non trouvée.'], 404);
          }

          // Validation pour l'ID du document
          $validated = $this->validateWithPermissions($request, [
              'prise_en_charge:associer_justificatif' => [
                  'document_id' => ['required', 'uuid', 'exists:documents,id'], // Assumant une table 'documents' avec UUID
              ],
          ]);

          // Implémenter la logique de liaison de document ici
          // Cela dépend de la structure de votre relation avec les documents (Many-to-Many, HasMany, etc.)
          // Exemple pour une relation Many-to-Many 'documents()' sur le modèle PriseEnCharge:
          // try {
          //      $priseEnCharge->documents()->attach($validated['document_id']);
          //      if (Auth::check()) {
          //         // Mettre à jour updated_by_user_id si la liaison est considérée comme une modification
          //          $priseEnCharge->update(['updated_by_user_id' => Auth::id()]);
          //      }
          //      return response()->json(['message' => 'Justificatif associé avec succès.', 'data' => $priseEnCharge], 200);
          // } catch (\Exception $e) {
          //      return response()->json(['message' => 'Échec de l\'association du justificatif.', 'error' => $e->getMessage()], 500);
          // }

          return response()->json(['message' => 'Liaison de justificatif non implémentée dans le modèle/contrôleur.', /* 'data' => $priseEnCharge */], 501); // 501 Not Implemented

      }
}
