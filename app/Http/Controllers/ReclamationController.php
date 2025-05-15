<?php

namespace App\Http\Controllers;

use App\Models\Réclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Mutualiste;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class RéclamationController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'reclamation:create'
        $validated = $this->validateWithPermissions($request, [
            'reclamation:create' => [
                'mutualiste_id' => ['required', 'uuid', 'exists:users,id'],
                'sujet' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                // Valider avec les statuts en majuscules
                'statut' => ['sometimes', 'required', 'string', Rule::in(['SOUMISE', 'EN COURS', 'RESOLUE', 'FERMEE', 'ESCALADEE'])],
                 'soumise_par_user_id' => ['required', 'uuid', 'exists:users,id'],
                 'assignee_a_admin_id' => ['nullable', 'uuid', 'exists:users,id'],
            ],
        ]);

         if (!isset($validated['reference'])) {
             $validated['reference'] = 'REC-' . Str::random(8);
         } else {
             $request->validate(['reference' => 'unique:reclamations,reference']);
         }

        // Définir le statut par défaut à 'SOUMISE' si non spécifié
         if (!isset($validated['statut'])) {
             $validated['statut'] = 'SOUMISE';
         }

        $validated['date_soumission'] = now();
        $validated['date_mise_a_jour_statut'] = now();

        $reclamation = Réclamation::create($validated);

        if (Auth::check()) {
             $reclamation->update([
                 'created_by_user_id' => Auth::id(),
                 'updated_by_user_id' => Auth::id(),
            ]);
             $reclamation->created_by_user_id = Auth::id();
             $reclamation->updated_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Réclamation créée avec succès.', 'data' => $reclamation], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'reclamation:update'
        try {
             $reclamation = Réclamation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Réclamation non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'reclamation:update' => [
                'reference' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('reclamations', 'reference')->ignore($reclamation->id)],
                'mutualiste_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
                'sujet' => ['sometimes', 'required', 'string', 'max:255'],
                'description' => ['sometimes', 'required', 'string'],
                 // Valider avec les statuts en majuscules
                 'statut' => ['sometimes', 'required', 'string', Rule::in(['SOUMISE', 'EN COURS', 'RESOLUE', 'FERMEE', 'ESCALADEE'])],
                 'assignee_a_admin_id' => ['nullable', 'uuid', 'exists:users,id'],
            ],
        ]);

         if (isset($validated['statut']) && $validated['statut'] !== $reclamation->statut) {
             $validated['date_mise_a_jour_statut'] = now();
         }

        $reclamation->fill($validated);

         if (Auth::check()) {
            $reclamation->updated_by_user_id = Auth::id();
         }

        $reclamation->save();

        return response()->json(['message' => 'Réclamation mise à jour avec succès.', 'data' => $reclamation], 200);
    }

     public function destroy(string $id)
     {
        // Permission: 'reclamation:delete'
        try {
             $reclamation = Réclamation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Réclamation non trouvée.'], 404);
        }

        try {
            $reclamation->delete();
             return response()->json(['message' => 'Réclamation supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la réclamation.', 'error' => $e->getMessage()], 500);
        }
     }

     public function assignToAdmin(Request $request, string $id)
     {
         // Permission: 'reclamation:assigner'
         try {
              $reclamation = Réclamation::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Réclamation non trouvée.'], 404);
         }

         $validated = $this->validateWithPermissions($request, [
             'reclamation:assigner' => [
                 'admin_id' => ['nullable', 'uuid', 'exists:users,id'],
             ],
         ]);

         $success = $reclamation->assignerA($validated['admin_id'] ?? null);

         if ($success) {
              if (Auth::check()) {
                 $reclamation->update(['updated_by_user_id' => Auth::id()]);
                 $reclamation->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Réclamation assignée avec succès.', 'data' => $reclamation], 200);
         } else {
              return response()->json(['message' => 'Échec de l\'assignation de la réclamation.'], 500);
         }
     }

     public function changeStatus(Request $request, string $id)
     {
         // Permission: 'reclamation:changer_statut'
         try {
              $reclamation = Réclamation::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Réclamation non trouvée.'], 404);
         }

         $validated = $this->validateWithPermissions($request, [
             'reclamation:changer_statut' => [
                 // Valider avec les statuts en majuscules
                 'statut' => ['required', 'string', Rule::in(['SOUMISE', 'EN COURS', 'RESOLUE', 'FERMEE', 'ESCALADEE'])],
             ],
         ]);

         $success = $reclamation->changerStatut($validated['statut']);

         if ($success) {
              if (Auth::check()) {
                 $reclamation->update(['updated_by_user_id' => Auth::id()]);
                 $reclamation->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Statut de la réclamation mis à jour avec succès.', 'data' => $reclamation], 200);
         } else {
              return response()->json(['message' => 'Échec du changement de statut de la réclamation (statut fourni invalide).'], 422);
         }
     }

      public function clotureReclamation(Request $request, string $id)
      {
          // Permission: 'reclamation:cloturer'
          try {
               $reclamation = Réclamation::findOrFail($id);
          } catch (ModelNotFoundException $e) {
               return response()->json(['message' => 'Réclamation non trouvée.'], 404);
          }

          $validated = $this->validateWithPermissions($request, [
              'reclamation:cloturer' => [
                  'resolution' => ['nullable', 'string'],
              ],
          ]);

          $success = $reclamation->cloturer($validated['resolution'] ?? null);

          if ($success) {
               if (Auth::check()) {
                  $reclamation->update(['updated_by_user_id' => Auth::id()]);
                  $reclamation->updated_by_user_id = Auth::id();
              }
              return response()->json(['message' => 'Réclamation clôturée avec succès.', 'data' => $reclamation], 200);
          } else {
               return response()->json(['message' => 'Échec de la clôture de la réclamation (statut actuel: ' . $reclamation->statut . ').'], 409);
          }
      }
}
