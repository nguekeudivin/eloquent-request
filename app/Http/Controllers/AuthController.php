<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TokenService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $user = User::where("username", $request->input("username"))->first();
        if ($user != null) {
            if (password_verify($request->input("password"), $user->password)) {
                $token = TokenService::generate([
                    "username" => $user->username,
                    "id" => $user->id
                ], 3600 * 24); // 24h
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully logged in',
                    'user' => $user,
                    'token' => $token,
                    'role' => $user->role
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Mot de passe ou numero de téléphone invalide",
                ], 401);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Mot de passe ou numero de téléphone invalide",
            ], 401);
        }
    }


    public function user(Request $request){

        $user = TokenService::user($request);

        if($user != null){
            $user->computeBalance();
        }

        return response()->json($user,201);
    }

}
