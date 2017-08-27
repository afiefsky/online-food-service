<?php

namespace OFS\Services;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationService
{
    private $user;

    /**
     * AuthenticationService constructor.
     * @param UserService $user
     */
    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function authenticate($credentials)
    {
        /* Check what role the user has */


        return JWTAuth::attempt($credentials);
    }
}