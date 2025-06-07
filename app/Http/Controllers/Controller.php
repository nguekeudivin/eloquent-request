<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function validateWithPermissions(Request $request, array $rules)
    {

        $userPermissions = $request->user()->getPermissions();

        $errors = [];
        $validatedData = [];

        foreach ($rules as $permissionRoot => $validationRules) {
            // Ignorer le bloc meta car il ne nécessite pas de vérification de permission
            if ($permissionRoot === 'meta') {
                $validator = Validator::make($request->only(array_keys($validationRules)), $validationRules);

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
                $errors['permission'] = "You cannot '{$operation}' a '{$modelName}' instance.";
                continue; // Si la permission racine manque, on ne vérifie pas les champs en dessous
            }

            // Verifier s'il y'a une permission totale sur les champs
            if (!in_array($permissionRoot.':*', $userPermissions)) {
                // Vérifier les permissions spécifiques pour chaque champ
                foreach ($validationRules as $field => $rulesArray) {
                    $permissionAttribute = $permissionRoot . ':' . $field;
                    if (!in_array($permissionAttribute, $userPermissions)) {
                        $modelName = Str::before($permissionRoot, ':');
                        $errors[$field] = ["You cannot define '{$field}' on a '{$modelName}' instance."];
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
            return (object)[
                'errors' => $errors,
                'fails' => true,
                'valid' => false
            ];
        }

        return (object)[
            'valid' => true,
            'fails' => false,
            'data' => $validatedData
        ];
    }
}
