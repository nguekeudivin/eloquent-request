<?php

namespace App\Http\Controllers;

use App\Models\TypeAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PermissionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;


class TypeAllocationController extends Controller
{
    use PermissionValidator;

    public function store(Request $request)
    {
        // Permission: 'type_allocation:create'
        $validated = $this->validateWithPermissions($request, [
            'type_allocation:create' => [
                'libelle' => ['required', 'string', 'max:255', 'unique:type_allocations,libelle'],
                'montant_standard' => ['required', 'decimal:0,2', 'min:0'],
                'montant_max' => ['required', 'decimal:0,2', 'min:0', 'gte:montant_standard'], // Max >= Standard
                'montant_min' => ['required', 'decimal:0,2', 'min:0', 'lte:montant_standard'], // Min <= Standard
            ],
        ]);

        if(isset($validated['errors'])){
            return response()->json($validated, 422);
        }


        $typeAllocation = TypeAllocation::create($validated);

        if (Auth::check()) {
             $typeAllocation->update(['created_by_user_id' => Auth::id()]);
             $typeAllocation->created_by_user_id = Auth::id();
        }

        return response()->json(['message' => 'TypeAllocation créé avec succès.', 'data' => $typeAllocation], 201);
    }

    public function update(Request $request, string $id)
    {
        // Permission: 'type_allocation:update'
        try {
             $typeAllocation = TypeAllocation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'TypeAllocation non trouvé.'], 404);
        }

        $validated = $this->validateWithPermissions($request, [
            'type_allocation:update' => [
                'libelle' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('type_allocations', 'libelle')->ignore($typeAllocation->id)],
                'montant_standard' => ['sometimes', 'required', 'decimal:0,2', 'min:0'],
                 // Gérer les validations gte/lte par rapport aux valeurs existantes ou nouvelles
                'montant_max' => ['sometimes', 'required', 'decimal:0,2', 'min:0', 'gte:' . ($request->has('montant_standard') ? 'montant_standard' : $typeAllocation->montant_standard)],
                'montant_min' => ['sometimes', 'required', 'decimal:0,2', 'min:0', 'lte:' . ($request->has('montant_standard') ? 'montant_standard' : $typeAllocation->montant_standard)],
            ],
        ]);

        $typeAllocation->fill($validated);

         if (Auth::check()) {
            $typeAllocation->updated_by_user_id = Auth::id();
         }

        $typeAllocation->save();

        return response()->json(['message' => 'TypeAllocation mis à jour avec succès.', 'data' => $typeAllocation], 200);
    }

    public function destroy(string $id)
    {
        // Permission: 'type_allocation:delete'
        try {
             $typeAllocation = TypeAllocation::findOrFail($id);
        } catch (ModelNotFoundException $e) {
             return response()->json(['message' => 'TypeAllocation non trouvé.'], 404);
        }

        try {
            $typeAllocation->delete();
             return response()->json(['message' => 'TypeAllocation supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du TypeAllocation.', 'error' => $e->getMessage()], 500);
        }
    }
}
