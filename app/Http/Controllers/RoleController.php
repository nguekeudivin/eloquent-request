<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function grant(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        $userRole = $user->roles()->create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        return response()->json($useRole, 200);
    }
}
