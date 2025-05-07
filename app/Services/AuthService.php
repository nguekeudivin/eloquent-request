<?php

namespace App\Services;

class AuthService
{
    static function user($request){
        return TokenService::user($request);
    }

}
