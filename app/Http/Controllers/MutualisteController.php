<?php

namespace App\Http\Controllers;

use App\Models\Mutualiste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;


use Illuminate\Validation\Rule; // Pour valider l'ENUM sexe
use App\Models\UserRole;
use App\Models\Role;
use App\Models\TypeStatut;
use Faker\Factory as Faker;

class MutualisteController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'sexe' => ['nullable', Rule::in(['H', 'F', 'Autre'])], // Validation de l'ENUM
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'date_premiere_adhesion' => 'required|date',
            // Informations pour l'utilisateur
            'email' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Recuperer le status actif.
        $actifStatus = TypeStatut::where('code_interne', 'USER_ACTIF')
            ->where('contexte', 'user')
            ->first();


       // Separate the validated data
        $validated = $validator->validated();

        $faker = Faker::create('fr_FR');

        // Data for Mutualiste model
        $mutualisteData = [
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'date_naissance' => $validated['date_naissance'],
            'lieu_naissance' => $validated['lieu_naissance'],
            'sexe' => $validated['sexe'],
            'adresse' => $validated['adresse'],
            'telephone' => $validated['telephone'],
            'profession' => $validated['profession'],
            'date_premiere_adhesion' => $validated['date_premiere_adhesion'],
            'numero_adherent' => $faker->unique()->numerify('MUT-######'), // Numéro d'adhérent unique
        ];

        // Data for User model
        $userData = [
            'email' => $validated['email'],
            'username' => $validated['username'],
        ];

        DB::beginTransaction();

        // Create l'utilisateur associee
        $user = User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => Hash::make('password'),
            'statut_id' => $actifStatus->id,
            'email_verified_at' => Carbon::now(),
                    //'last_connexion' => Carbon::now(),
        ]);
        $mutualisteData['id'] = $user->id;

        // Creer le role pour le mutualiste
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => Role::where('code','mutualiste')->first()->id
        ]);


        if (Auth::check()) {
            $mutualisteData['created_by_user_id'] = Auth::id();
        }

        $mutualiste = Mutualiste::create($mutualisteData);

        DB::commit();

        return response()->json(['message' => 'Mutualiste créé avec succès.', 'data' => $mutualiste], 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'numero_adherent' => 'string|max:255|unique:mutualistes,numero_adherent,' . $id,
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'date_naissance' => 'date',
            'lieu_naissance' => 'nullable|string|max:255',
            'sexe' => ['nullable', Rule::in(['H', 'F', 'Autre'])],
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'statut_social' => 'nullable|string|max:255',
            'date_premiere_adhesion' => 'date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mutualiste = Mutualiste::find($id);

        if (!$mutualiste) {
            return response()->json(['message' => 'Mutualiste non trouvé.'], 404);
        }

        $mutualiste->fill($validator->validated());

         if (Auth::check()) {
            $mutualiste->updated_by_user_id = Auth::id();
         }

        $mutualiste->save();

        return response()->json(['message' => 'Mutualiste mis à jour avec succès.', 'data' => $mutualiste], 200);
    }

    public function destroy(string $id)
    {
        $mutualiste = Mutualiste::find($id);

        if (!$mutualiste) {
            return response()->json(['message' => 'Mutualiste non trouvé.'], 404);
        }

        try {
            $mutualiste->delete();
             return response()->json(['message' => 'Mutualiste supprimé avec succès.', 'id' => $id], 200);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la suppression du mutualiste.', 'error' => $e->getMessage()], 500);
        }
    }
}
