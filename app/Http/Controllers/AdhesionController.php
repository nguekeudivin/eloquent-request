<?php

namespace App\Http\Controllers;

use App\Models\Adhesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Mutualiste; // Pour validation exists (via users table)
use App\Models\Contrat; // Pour validation exists
use Illuminate\Support\Carbon;


class AdhesionController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'adhesion:create' => [ // Permission pattern prefix
                // mutualiste_id référence l'ID user, donc validation sur la table users
                'mutualiste_id' => ['required', 'uuid', 'exists:users,id'],
                // contrat_id est UUID
                'contrat_id' => ['required', 'uuid', 'exists:contrats,id'],
                'date_debut' => ['required', 'date'],
                // date_fin, statut, reference_externe, motif_resiliation sont optionnels à la création
                 'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
                 'statut' => ['sometimes', 'required', 'string', Rule::in(['actif', 'résilié', 'expiré', 'suspendu', 'inactif'])],
                 'reference_externe' => ['nullable', 'string', 'max:255'],
                 'motif_resiliation' => ['nullable', 'string'],
            ],
        ]);

        // Si le statut n'est pas fourni, le définir à 'actif' par défaut à la création
         if (!isset($validated['statut'])) {
             $validated['statut'] = 'actif';
         }

        // Créer l'adhésion en utilisant create()
        $adhesion = Adhesion::create($validated);

        // Définir le champ created_by_user_id après la création car il est gardé
        if (Auth::check()) {
             $adhesion->update(['created_by_user_id' => Auth::id()]);
             $adhesion->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Adhesion créée avec succès.', 'data' => $adhesion], 201);
    }

    public function update(Request $request, string $id)
    {
        try {
             $adhesion = Adhesion::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Adhesion non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'adhesion:update' => [ // Permission pattern prefix
                'mutualiste_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
                'contrat_id' => ['sometimes', 'required', 'uuid', 'exists:contrats,id'],
                'date_debut' => ['sometimes', 'required', 'date'],
                 // date_fin doit être >= date_debut (existante ou dans la requête)
                 'date_fin' => ['nullable', 'date', 'after_or_equal:' . ($request->has('date_debut') ? 'date_debut' : $adhesion->date_debut?->toDateString())],
                'statut' => ['sometimes', 'required', 'string', Rule::in(['actif', 'résilié', 'expiré', 'suspendu', 'inactif'])],
                'reference_externe' => ['nullable', 'string', 'max:255'],
                'motif_resiliation' => ['nullable', 'string'],
            ],
        ]);

        $adhesion->fill($validated); // fill() est nécessaire pour mettre à jour

         if (Auth::check()) {
            $adhesion->updated_by_user_id = Auth::id();
         }

        $adhesion->save(); // Sauvegarder les mises à jour

        return response()->json(['message' => 'Adhesion mise à jour avec succès.', 'data' => $adhesion], 200);
    }

     // Opération 'resilier(dateFin, motif)' -> custom method 'resilier'
     // Permission: 'adhesion:resilier' (+ Policy)
    public function resilier(Request $request, string $id)
    {
        // Permission check for the resilier operation
        // e.g., Auth::user()->can('adhesion:resilier') and Auth::user()->can('resilier', $adhesion) Policy check

        try {
             $adhesion = Adhesion::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Adhesion non trouvée.'], 404);
        }

         // Validation spécifique pour la résiliation
        $validated = $this->validateWithPermissions($request, [
            'adhesion:resilier' => [
                // date_fin optionnelle, date, après la date de début (existante dans le modèle)
                 'date_fin' => ['nullable', 'date', 'after_or_equal:' . $adhesion->date_debut?->toDateString()],
                'motif' => ['nullable', 'string', 'max:255'], // Motif optionnel
            ],
        ]);

        // Utilise la méthode du modèle pour résilier
        // Passe la date de fin validée et le motif
        $success = $adhesion->resilier($validated['date_fin'] ?? null, $validated['motif'] ?? null); // Utilise la date de fin de la requête ou null

        if ($success) {
             // Optionnel : Mettre à jour updated_by_user_id après la méthode du modèle
             if (Auth::check()) {
                 $adhesion->update(['updated_by_user_id' => Auth::id()]);
                 $adhesion->updated_by_user_id = Auth::id(); // Mettre à jour l'instance en mémoire
             }
             return response()->json(['message' => 'Adhesion résiliée avec succès.', 'data' => $adhesion], 200);
        } else {
             return response()->json(['message' => 'Échec de la résiliation de l\'Adhesion.'], 500);
        }
    }

    // Opération 'suspendre()' -> custom method 'suspendre'
     // Permission: 'adhesion:suspendre' (+ Policy)
     public function suspendre(string $id)
     {
         // Permission check for suspendre operation
         // e.g., Auth::user()->can('adhesion:suspendre') and Auth::user()->can('suspendre', $adhesion) Policy check

         try {
              $adhesion = Adhesion::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Adhesion non trouvée.'], 404);
         }

         // Utilise la méthode du modèle
         $success = $adhesion->suspendre();

         if ($success) {
              if (Auth::check()) {
                 $adhesion->update(['updated_by_user_id' => Auth::id()]);
                 $adhesion->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Adhesion suspendue avec succès.', 'data' => $adhesion], 200);
         } else {
              return response()->json(['message' => 'Échec de la suspension de l\'Adhesion.'], 500);
         }
     }

    // Opération 'reactiver()' -> custom method 'reactiver'
     // Permission: 'adhesion:reactiver' (+ Policy)
     public function reactiver(string $id)
     {
         // Permission check for reactiver operation
         // e.g., Auth::user()->can('adhesion:reactiver') and Auth::user()->can('reactiver', $adhesion) Policy check

         try {
              $adhesion = Adhesion::findOrFail($id);
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Adhesion non trouvée.'], 404);
         }

         // Utilise la méthode du modèle
         $success = $adhesion->reactiver();

         if ($success) {
              if (Auth::check()) {
                 $adhesion->update(['updated_by_user_id' => Auth::id()]);
                 $adhesion->updated_by_user_id = Auth::id();
             }
             return response()->json(['message' => 'Adhesion réactivée avec succès.', 'data' => $adhesion], 200);
         } else {
              return response()->json(['message' => 'Échec de la réactivation de l\'Adhesion.'], 500);
         }
     }

      // Opération 'desactiver()' (si 'inactiver') -> custom method 'inactiver'
      // Permission: 'adhesion:inactiver' (+ Policy)
      public function inactiver(string $id)
      {
          // Permission check for inactiver operation
          // e.g., Auth::user()->can('adhesion:inactiver') and Auth::user()->can('inactiver', $adhesion) Policy check

          try {
               $adhesion = Adhesion::findOrFail($id);
          } catch (ModelNotFoundException $e) {
               return response()->json(['message' => 'Adhesion non trouvée.'], 404);
          }

          // Utilise la méthode du modèle
          $success = $adhesion->inactiver();

          if ($success) {
               if (Auth::check()) {
                  $adhesion->update(['updated_by_user_id' => Auth::id()]);
                  $adhesion->updated_by_user_id = Auth::id();
              }
              return response()->json(['message' => 'Adhesion inactivée avec succès.', 'data' => $adhesion], 200);
          } else {
               return response()->json(['message' => 'Échec de l\'inactivation de l\'Adhesion.'], 500);
          }
      }

     // Opération implicite 'supprimer()' -> destroy (standard DELETE HTTP)
     // Permission: 'adhesion:delete' (+ Policy)
     public function destroy(string $id)
     {
         // Permission check for deleting an adhesion
        // e.g., Auth::user()->can('adhesion:delete') and Auth::user()->can('delete', $adhesion) Policy check

        try {
             $adhesion = Adhesion::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Adhesion non trouvée.'], 404);
        }

        try {
            $adhesion->delete();
             return response()->json(['message' => 'Adhesion supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de l\'Adhesion.', 'error' => $e->getMessage()], 500);
        }
     }

     // Opération 'genererCotisations()' -> custom method
     // Permission: 'adhesion:generer_cotisations' (+ Policy)
     public function generateCotisations(string $id)
     {
         // Permission check
         // e.g., Auth::user()->can('adhesion:generer_cotisations') and Auth::user()->can('genererCotisations', $adhesion) Policy check

          try {
               $adhesion = Adhesion::findOrFail($id);
                // Assurez-vous que la relation 'contrat' est chargée si nécessaire pour genererCotisations
               $adhesion->load('contrat');
          } catch (ModelNotFoundException $e) {
               return response()->json(['message' => 'Adhesion non trouvée.'], 404);
          }


          // Utilisez la méthode du modèle pour générer les cotisations
          // Nécessite que la méthode 'genererCotisations' soit implémentée dans le modèle Adhesion
          // $cotisations = $adhesion->genererCotisations(); // Décommenter quand la méthode est implémentée

          // Retourner une réponse appropriée, par exemple, la liste des cotisations générées
          return response()->json(['message' => 'Génération de cotisations non implémentée dans le modèle.', /* 'data' => $cotisations */], 501); // Retourner 501 Not Implemented ou 200 OK avec les données

     }
}
