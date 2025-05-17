<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Mutualiste; // Pour validation exists (via users table)
use App\Models\TypeAllocation; // Pour validation exists
use App\Models\User; // Pour validation exists


class AllocationController extends Controller
{
    use PermissionValidator;

    // Opération 'accorder(mutualisteId, montant, motif, adminId)' -> store
    public function store(Request $request)
    {
        // Permission: 'allocation:create'
        // e.g., Auth::user()->can('allocation:create')

        $validated = $this->validateWithPermissions($request, [
            'allocation:create' => [ // Permission pattern prefix
                // mutualiste_id référence l'ID user, donc validation sur la table users
                'mutualiste_id' => ['required', 'uuid', 'exists:users,id'],
                'type_allocation_id' => ['required', 'integer', 'exists:type_allocations,id'],
                'date' => ['required', 'date'], // Date de la demande/de l'accord initial
                'montant' => ['required', 'decimal:0,2', 'min:0'], // Montant demandé/accordé
                'motif' => ['required', 'string'],
                // Statut initial est généralement 'accordée' lors de la création via cette API
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
       }

        // Définir le statut par défaut à 'accordée' si non spécifié
         if (!isset($validated['statut'])) {
             $validated['statut'] = 'ACCORDEE';
         }

        // Créer l'allocation en utilisant create()
        $allocation = Allocation::create($validated);

        // Définir les champs created_by_user_id et updated_by_user_id
        if (Auth::check()) {
             $allocation->update([
                 'created_by_user_id' => Auth::id(),
                 'updated_by_user_id' => Auth::id(),
            ]);
             $allocation->created_by_user_id = Auth::id();
             $allocation->updated_by_user_id = Auth::id();
        }

        $allocation->mutualiste;
        $allocation->type_allocation;

        return response()->json(['message' => 'Allocation créée avec succès.', 'data' => $allocation], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'allocation:update'
        // e.g., Auth::user()->can('allocation:update') and Auth::user()->can('update', $allocation) Policy check

        try {
             $allocation = Allocation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Allocation non trouvée.'], 404);
        }

        // Note: La mise à jour directe de certains champs (ex: mutualiste_id, type_allocation_id)
        // peut être restreinte selon les règles métier ou les permissions.
        $validated = $this->validateWithPermissions($request, [
            'allocation:update' => [ // Permission pattern prefix
                'mutualiste_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
                'type_allocation_id' => ['sometimes', 'required', 'integer', 'exists:type_allocations,id'],
                'date' => ['sometimes', 'required', 'date'],
                'montant' => ['sometimes', 'required', 'decimal:0,2', 'min:0'],
                'motif' => ['sometimes', 'required', 'string'],
                 // Permettre la mise à jour du statut via update si permis
                 'statut' => ['sometimes', 'required', 'string', Rule::in(['ACCORDEE','VERSEE','REFUSEE','ANNULEE'])],
            ],
        ]);


        if(isset($validated['errors'])){
            return response()->json($validated, 422);
       }


        $allocation->fill($validated);

         if (Auth::check()) {
            $allocation->updated_by_user_id = Auth::id();
         }

        $allocation->save();

        $allocation->mutualiste;
        $allocation->type_allocation;

        return response()->json(['message' => 'Allocation mise à jour avec succès.', 'data' => $allocation], 200);
    }

     // Opération 'marquerVersee(adminId)' -> custom method 'markAsVersée'
     // Permission: 'allocation:marquer_versee' (+ Policy)
    public function markAsVersée(string $id)
    {
        // Permission check for markAsVersée operation
        // e.g., Auth::user()->can('allocation:marquer_versee') and Auth::user()->can('marquerVersee', $allocation) Policy check

        try {
             $allocation = Allocation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Allocation non trouvée.'], 404);
        }

         // Policy check
         // if (Auth::check() && Auth::user()->cannot('marquerVersee', $allocation)) {
         //      abort(403, 'Vous n\'êtes pas autorisé à marquer cette allocation comme versée.');
         // }

        // Utilise la méthode du modèle pour marquer comme versée
        // Passe l'ID de l'utilisateur authentifié s'il existe
        $success = $allocation->marquerVersee(Auth::id());

        if ($success) {
             // updated_by_user_id est déjà mis à jour par la méthode du modèle si elle appelle save()
             // ou peut être mis à jour ici si nécessaire
             if (Auth::check()) {
                 $allocation->update(['updated_by_user_id' => Auth::id()]);
                 $allocation->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Allocation marquée comme versée avec succès.', 'data' => $allocation], 200);
        } else {
             return response()->json(['message' => 'Échec de la mise à jour du statut "versée" (statut actuel: ' . $allocation->statut . ').'], 409); // 409 Conflict si statut non compatible
        }
    }

     // Opération 'refuser(motif)' -> custom method 'refuseAllocation'
     // Permission: 'allocation:refuser' (+ Policy)
     public function refuseAllocation(Request $request, string $id)
     {
         // Permission check for refuseAllocation operation
         // e.g., Auth::user()->can('allocation:refuser') and Auth::user()->can('refuser', $allocation) Policy check

         try {
              $allocation = Allocation::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Allocation non trouvée.'], 404);
         }

         // Validation spécifique pour le motif de refus
         $validated = $this->validateWithPermissions($request, [
             'allocation:refuser' => [
                 'motif' => ['nullable', 'string'], // Motif de refus optionnel
             ],
         ]);

          // Policy check
         // if (Auth::check() && Auth::user()->cannot('refuser', $allocation)) {
         //      abort(403, 'Vous n\'êtes pas autorisé à refuser cette allocation.');
         // }

         // Utilise la méthode du modèle pour refuser
         // Passe le motif de refus validé
         $success = $allocation->refuser($validated['motif'] ?? null);

         if ($success) {
              if (Auth::check()) {
                 // Mettre à jour updated_by_user_id et potentiellement verifiee_par_admin_id si l'admin qui refuse est celui qui vérifie
                 $updateData = ['updated_by_user_id' => Auth::id()];
                 // Si l'allocation n'était pas encore vérifiée, l'admin qui refuse devient l'admin vérificateur
                 if (is_null($allocation->verifiee_par_admin_id)) {
                      $updateData['verifiee_par_admin_id'] = Auth::id();
                 }
                 $allocation->update($updateData);
                 $allocation->updated_by_user_id = Auth::id();
                 if (isset($updateData['verifiee_par_admin_id'])) {
                      $allocation->verifiee_par_admin_id = $updateData['verifiee_par_admin_id'];
                 }
             }
             return response()->json(['message' => 'Allocation refusée avec succès.', 'data' => $allocation], 200);
         } else {
              return response()->json(['message' => 'Échec du refus de l\'Allocation (statut actuel: ' . $allocation->statut . ').'], 409); // 409 Conflict si statut non compatible
         }
     }

      // Opération 'annuler()' -> custom method 'cancelAllocation'
      // Permission: 'allocation:annuler' (+ Policy)
      public function cancelAllocation(string $id)
      {
          // Permission check for cancelAllocation operation
          // e.g., Auth::user()->can('allocation:annuler') and Auth::user()->can('annuler', $allocation) Policy check

          try {
               $allocation = Allocation::findOrFail($id);
          } catch (ModelNotFoundException $e) {
               return response()->json(['message' => 'Allocation non trouvée.'], 404);
          }

           // Policy check
          // if (Auth::check() && Auth::user()->cannot('annuler', $allocation)) {
          //      abort(403, 'Vous n\'êtes pas autorisé à annuler cette allocation.');
          // }

          // Utilise la méthode du modèle
          $success = $allocation->annuler();

          if ($success) {
               if (Auth::check()) {
                  $allocation->update(['updated_by_user_id' => Auth::id()]);
                  $allocation->updated_by_user_id = Auth::id();
              }
              return response()->json(['message' => 'Allocation annulée avec succès.', 'data' => $allocation], 200);
          } else {
               return response()->json(['message' => 'Échec de l\'annulation de l\'Allocation (statut actuel: ' . $allocation->statut . ').'], 409); // 409 Conflict
          }
      }


     // Opération implicite 'supprimer()' -> destroy (standard DELETE HTTP)
     // Permission: 'allocation:delete' (+ Policy)
     public function destroy(string $id)
     {
         // Permission check for deleting an allocation
        // e.g., Auth::user()->can('allocation:delete') and Auth::user()->can('delete', $allocation) Policy check

        try {
             $allocation = Allocation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Allocation non trouvée.'], 404);
        }

         // Policy check
         // if (Auth::check() && Auth::user()->cannot('delete', $allocation)) {
         //      abort(403, 'Vous n\'êtes pas autorisé à supprimer cette allocation.');
         // }

        try {
            $allocation->delete();
             return response()->json(['message' => 'Allocation supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de l\'Allocation.', 'error' => $e->getMessage()], 500);
        }
     }
}
