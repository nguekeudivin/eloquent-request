<?php

namespace App\Http\Controllers;

use App\Models\ConversationParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Carbon;


class ConversationParticipantController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        $validated = $this->validateWithPermissions($request, [
            'conversation_participant:create' => [
                'conversation_id' => ['required', 'uuid', 'exists:conversations,id'],
                'utilisateur_id' => ['required', 'uuid', 'exists:users,id'],
                 // Optionnel : validation pour éviter les doublons actifs
                 Rule::unique('conversation_participant')->where(function ($query) use ($request) {
                     return $query->where('conversation_id', $request->conversation_id)
                                  ->where('utilisateur_id', $request->utilisateur_id)
                                  ->where('est_actif', true);
                 })
            ],
        ]);

        // Rechercher si une entrée inactive existe déjà
        $participant = ConversationParticipant::where('conversation_id', $validated['conversation_id'])
                                              ->where('utilisateur_id', $validated['utilisateur_id'])
                                              ->first();

        if ($participant) {
            // Si une entrée existe (probablement inactive), la réactiver
            if (!$participant->est_actif) {
                $participant->est_actif = true;
                $participant->date_jointure = now(); // Mettre à jour la date de jointure si réactivé
                $participant->save();

                 return response()->json(['message' => 'Participant réactivé dans la conversation.', 'data' => $participant], 200);
            } else {
                // Si déjà actif, retourner une erreur (ou un succès avec message)
                 return response()->json(['message' => 'L\'utilisateur est déjà un participant actif de cette conversation.'], 409); // Conflict
            }
        } else {
            // Si aucune entrée n'existe, créer une nouvelle entrée
            $validated['date_jointure'] = now();
            $validated['est_actif'] = true; // Par défaut actif

            $participant = ConversationParticipant::create($validated);

            return response()->json(['message' => 'Participant ajouté à la conversation.', 'data' => $participant], 201);
        }
    }


     public function destroy(string $conversationId, string $utilisateurId)
     {
         // Permission check
         // e.g., Auth::user()->can('conversation_participant:delete') or Auth::user()->can('conversation:retirer_participant')

         try {
              // Trouver l'entrée spécifique dans la table pivot
              $participant = ConversationParticipant::where('conversation_id', $conversationId)
                                                    ->where('utilisateur_id', $utilisateurId)
                                                    ->firstOrFail();
         } catch (ModelNotFoundException $e) {
              return response()->json(['message' => 'Participant non trouvé dans cette conversation.'], 404);
         }

         // Logique pour "retirer" le participant : changer est_actif à false
         try {
             $participant->delete();

             return response()->json(['message' => 'Participant retiré de la conversation.', 'data' => $participant], 200);
         } catch (\Exception $e) {
              return response()->json(['message' => 'Erreur lors du retrait du participant.', 'error' => $e->getMessage()], 500);
         }
     }
}
