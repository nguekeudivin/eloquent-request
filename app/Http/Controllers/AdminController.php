<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'name' => 'required|string|max:255',
        ]);

        // Create the User
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Create the Admin with same user ID
        $admin = Admin::create([
            'id' => $user->id,
            'name' => $validated['name'],
        ]);

        $admin->load('user');

        return response()->json($admin, 201);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'email' => 'nullable|email|unique:users,email,' . $admin->id,
            'name' => 'nullable|string|max:255',
        ]);

        if (isset($validated['name'])) {
            $admin->update(['name' => $validated['name']]);
        }

        if (isset($validated['email'])) {
            $admin->user->update(['email' => $validated['email']]);
        }

        return response()->json($admin);
    }

    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        $adminData = $admin->toArray();
        $admin->delete();

        return response()->json($adminData, 200);
    }
}
