<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NotificationController extends Controller
{
    public function update(Request $request, string $id)
    {
        try {
             $notification = Notification::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Notification non trouvée.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'est_lue' => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $notification->fill($validatedData);
        $notification->date_lecture = now();

        $notification->save();

        return response()->json(['message' => 'Notification mise à jour avec succès.', 'data' => $notification], 200);
    }

    public function destroy(string $id)
    {
        try {
             $notification = Notification::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Notification non trouvée.'], 404);
        }

        try {
            $notification->delete();
             return response()->json(['message' => 'Notification supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la notification.', 'error' => $e->getMessage()], 500);
        }
    }

    public function readAll(Request $request){

        Notification::where('user_id', $request->userId)->update([
            'est_lue' => true,
            'date_lecture' => now(),
        ]);

        return response()->json(['message' => 'Notifications mise à jour avec succès.'], 200);
    }
}
