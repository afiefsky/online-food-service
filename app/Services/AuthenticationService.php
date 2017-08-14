<?php

namespace OFS\Services;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationService
{
    public function authenticate($credentials)
    {
        return JWTAuth::attempt($credentials);
    }
}