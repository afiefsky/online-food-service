<?php
namespace OFS\Http\Controllers\API;

use OFS\Services\UserService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use OFS\Services\AuthenticationService;

class AuthenticationController extends APIController
{
    /**
     * @var AuthenticationService
     */
    private $auth;

    /**
     * @var UserService
     */
    private $user;

    /**
     * AuthenticationController constructor.
     * @param AuthenticationService $auth
     * @param UserService $user
     */
    public function __construct(
        AuthenticationService $auth,
        UserService $user
    )
    {
        $this->auth = $auth;
        $this->user = $user;
    }

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = $this->auth->authenticate($credentials)) {
                return $this->responseJson(['error' => 'invalid_credentials'], 401);
            }

            $user = $this->user->getByEmail($request['email']);
            $user['token'] = $token;
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->responseJson(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return $this->responseJson($user);
    }
}