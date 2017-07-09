<?php
namespace OFS\Http\Controllers\API;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use VTI\MKG\Services\AuthenticationService;

class AuthenticationController extends APIController
{
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->responseJson(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->responseJson(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return $this->responseJson(compact('token'));
    }
}