<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Carbon;


class MessageController extends Controller
{
    use PermissionValidator;

    // Opération 'creer(conversationId, utilisateurId, contenu)' -> store
    public function store(Request $request)
    {
        // Permission: 'message:create'
        $validated = $this->validateWithPermissions($request, [
            'message:create' => [
                'conversation_id' => ['required', 'uuid', 'exists:conversations,id'],
                // user_id doit exister et idéalement être un participant de la conversation
                'user_id' => ['required', 'uuid', 'exists:users,id'], // Optionnel: Rule::exists('conversation_participants', 'user_id')->where('conversation_id', $request->conversation_id)
                'contenu' => ['required', 'string'],
                // est_lu est false par défaut à la création
                'est_lu' => ['boolean'], // Permettre de le spécifier si besoin
            ],
        ]);

        $validated['date_envoi'] = now();

        $message = Message::create($validated);

        return response()->json(['message' => 'Message créé avec succès.', 'data' => $message], 201);
    }

    public function update(Request $request, string $id)
    {
        try {
             $message = Message::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Message non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'message:update' => [
                'contenu' => ['sometimes', 'required', 'string'],
                'est_lu' => ['sometimes', 'boolean'],
            ],
        ]);

        $message->fill($validated);
        $message->save();

        return response()->json(['message' => 'Message mis à jour avec succès.', 'data' => $message], 200);
    }

     public function destroy(string $id)
     {
        try {
             $message = Message::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Message non trouvé.'], 404);
        }

        try {
            $message->delete();
             return response()->json(['message' => 'Message supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du message.', 'error' => $e->getMessage()], 500);
        }
     }

}
