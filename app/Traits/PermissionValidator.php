<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait PermissionValidator
{

    protected function validateWithPermissions(Request $request, array $rules)
    {

        $userPermissions = $request->user()->getPermissions();

        $errors = [];
        $validatedData = [];

        foreach ($rules as $permissionRoot => $validationRules) {
            // Ignorer le bloc meta car il ne nécessite pas de vérification de permission
            if ($permissionRoot === 'meta') {
                $validator = Validator::make($request->all(), $validationRules);
                if ($validator->fails()) {
                    $errors = array_merge($errors, $validator->errors()->toArray());
                } else {
                    $validatedData = array_merge($validatedData, $validator->validated());
                }
                continue;
            }

            // Vérifier la permission racine
            if (!in_array($permissionRoot, $userPermissions)) {
                $modelName = Str::before($permissionRoot, ':');
                $operation = Str::after($permissionRoot, ':');
                $errors['permission'] = "Vous n'avez pas la permission d'effectuer l'opération '{$operation}' sur le modèle '{$modelName}'.";
                continue; // Si la permission racine manque, on ne vérifie pas les champs en dessous
            }

            // Verifier s'il y'a une permission totale sur les champs
            if(!in_array($permissionRoot.':*', $userPermissions)){
                // Vérifier les permissions spécifiques pour chaque champ
                foreach ($validationRules as $field => $rulesArray) {
                    $permissionAttribute = $permissionRoot . ':' . $field;
                    if (!in_array($permissionAttribute, $userPermissions)) {
                        $modelName = Str::before($permissionRoot, ':');
                        $errors[$field] = ["Vous n'avez pas la permission d'attribuer la valeur au champ '{$field}' lors de la création/modification du modèle '{$modelName}'."];
                    }
                }
            }


            // Si toutes les permissions pour ce bloc sont présentes, valider les données
            if (!isset($errors['permission']) && !array_intersect_key(array_flip(array_keys($validationRules)), $errors)) {
                $validator = Validator::make($request->only(array_keys($validationRules)), $validationRules);
                if ($validator->fails()) {
                    $errors = array_merge($errors, $validator->errors()->toArray());
                } else {
                    $validatedData = array_merge($validatedData, $validator->validated());
                }
            }
        }

        if (!empty($errors)) {
            return [
                'messages' => isset($errors['permission']) ? $errors['permission'] : 'Erreurs de validation basées sur les permissions.',
                'errors' => $errors,
            ];
        }

        return $validatedData;
    }
}
