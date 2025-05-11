<?php

namespace App\Http\Controllers;

use App\Traits\PermissionValidator;
use Illuminate\Http\Request;

class BluePrintController extends Controller
{
    use PermissionValidator; // Le trait pour gérer la validation par permission

    public function store(Request $request)
    {
        // Validation en fonction des permissions
        $validated = $this->validateWithPermissions($request, [
            'user:create' => [
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:8'],
            ],
            '#' => [
                'ref_code' => ['nullable', 'string'],
                'send_email' => ['boolean'],
            ],
            'profile:create' => [
                'name' => ['required', 'string', 'max:255'],
            ],
        ]);

        // Traitement après validation (enregistrement dans la base de données, etc.)
        // ...
    }
}
