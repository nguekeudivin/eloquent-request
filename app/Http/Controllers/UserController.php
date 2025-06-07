<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StatusType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = [
            "email" => $request->email,
            "password" => Hash::make($userData['password']),
        ];

        return response()->json($user, 201);
    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $userData = $user->toArray();
        $user->delete();

        return response()->json($userData, 200);
    }
}
