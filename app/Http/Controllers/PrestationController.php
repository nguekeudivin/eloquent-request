<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use App\Models\TypePrestation;


class PrestationController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'prestation:create'
        $validated = $this->validateWithPermissions($request, [
            'prestation:create' => [
                'nom' => ['required', 'string', 'max:255', 'unique:prestations,nom'],
                'description' => ['nullable', 'string'],
                'code_interne' => ['nullable', 'string', 'max:255', 'unique:prestations,code_interne'],
                'montant_reference' => ['nullable', 'decimal:0,2', 'min:0'],
                'est_active' => ['boolean'], // Par défaut à true, peut être spécifié
                'type_prestation_id' => ['nullable', 'integer', 'exists:type_prestations,id'],
            ],
        ]);

        // Si est_active n'est pas fourni, le définir à true par défaut à la création
         if (!isset($validated['est_active'])) {
             $validated['est_active'] = true;
         }

        $prestation = Prestation::create($validated);

        if (Auth::check()) {
             $prestation->update(['created_by_user_id' => Auth::id()]);
             $prestation->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'Prestation créée avec succès.', 'data' => $prestation], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'prestation:update'
        try {
             $prestation = Prestation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Prestation non trouvée.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'prestation:update' => [
                'nom' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('prestations', 'nom')->ignore($prestation->id)],
                'description' => ['nullable', 'string'],
                'code_interne' => ['nullable', 'string', 'max:255', Rule::unique('prestations', 'code_interne')->ignore($prestation->id)],
                'montant_reference' => ['nullable', 'decimal:0,2', 'min:0'],
                'est_active' => ['sometimes', 'boolean'],
                'type_prestation_id' => ['nullable', 'integer', 'exists:type_prestations,id'],
            ],
        ]);

        $prestation->fill($validated);

         if (Auth::check()) {
            $prestation->updated_by_user_id = Auth::id();
         }

        $prestation->save();

        return response()->json(['message' => 'Prestation mise à jour avec succès.', 'data' => $prestation], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'prestation:delete'
        try {
             $prestation = Prestation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'Prestation non trouvée.'], 404);
        }

        try {
            $prestation->delete();
             return response()->json(['message' => 'Prestation supprimée avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression de la Prestation.', 'error' => $e->getMessage()], 500);
        }
    }
}
