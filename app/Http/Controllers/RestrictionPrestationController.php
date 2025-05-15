<?php

namespace App\Http\Controllers;

use App\Models\RestrictionPrestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\Mutualiste;
use App\Models\TypePrestation;


class RestrictionPrestationController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'restriction_prestation:create'
        $validated = $this->validateWithPermissions($request, [
            'restriction_prestation:create' => [
                'mutualiste_id' => ['required', 'uuid', 'exists:users,id'],
                'type_prestation_id' => ['required', 'integer', 'exists:type_prestations,id'],
                'date_expiration' => ['nullable', 'date', 'after_or_equal:today'], // Date d'expiration future ou nulle
                 // Unicité composite mutualiste_id + type_prestation_id
                 Rule::unique('restriction_prestations')->where(function ($query) use ($request) {
                     return $query->where('mutualiste_id', $request->mutualiste_id);
                 })->where(function ($query) use ($request) {
                     return $query->where('type_prestation_id', $request->type_prestation_id);
                 })
            ],
        ]);

        $restrictionPrestation = RestrictionPrestation::create($validated);

        if (Auth::check()) {
             $restrictionPrestation->update(['created_by_user_id' => Auth::id()]);
             $restrictionPrestation->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'RestrictionPrestation créée avec succès.', 'data' => $restrictionPrestation], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'restriction_prestation:update'
        try {
             $restrictionPrestation = RestrictionPrestation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'RestrictionPrestation non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'restriction_prestation:update' => [
                'mutualiste_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
                'type_prestation_id' => ['sometimes', 'required', 'integer', 'exists:type_prestations,id'],
                'date_expiration' => ['nullable', 'date', 'after_or_equal:today'],
                 // Unicité composite pour la mise à jour
                 Rule::unique('restriction_prestations')->where(function ($query) use ($request, $restrictionPrestation) {
                     $mutualisteId = $request->has('mutualiste_id') ? $request->mutualiste_id : $restrictionPrestation->mutualiste_id;
                     $typeId = $request->has('type_prestation_id') ? $request->type_prestation_id : $restrictionPrestation->type_prestation_id;
                     return $query->where('mutualiste_id', $mutualisteId)->where('type_prestation_id', $typeId);
                 })->ignore($restrictionPrestation->id)
            ],
        ]);

        $restrictionPrestation->fill($validated);

         if (Auth::check()) {
            $restrictionPrestation->updated_by_user_id = Auth::id();
         }

        $restrictionPrestation->save();

        return response()->json(['message' => 'RestrictionPrestation mise à jour avec succès.', 'data' => $restrictionPrestation], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'restriction_prestation:delete'
        try {
             $restrictionPrestation = RestrictionPrestation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'RestrictionPrestation non trouvée.'], 404);
        }

        try {
            $restrictionPrestation->delete();
             return response()->json(['message' => 'RestrictionPrestation supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la RestrictionPrestation.', 'error' => $e->getMessage()], 500);
        }
    }
}
