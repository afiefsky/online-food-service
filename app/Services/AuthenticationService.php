<?php

namespace OFS\Services;

use Illuminate\Support\Facades\Auth;
use OFS\Entities\UserRole;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationService
{
    /**
     * @var UserService
     */
    private $user;
    /**
     * @var UserRoleService
     */
    private $userRole;

    /**
     * AuthenticationService constructor.
     * @param UserService $user
     * @param UserRoleService $userRole
     * @param CourierService $courier
     */
    public function __construct(
        UserService $user,
        UserRoleService $userRole,
        CourierService $courier)
    {
        $this->user = $user;
        $this->userRole = $userRole;
        $this->courier = $courier;
    }

    public function authenticate($credentials)
    {
        /* Get User ID */
        $user = $this->user->getByEmail($credentials['email']);

        /* Check what role the user has */
        $userRole = $this->userRole->get($user['id']);

        /**
         * Role Documentation
         * ID of roles
         * administrator = 2
         * courier = 3
         * customer = 4
         */

        if ($userRole['role_id'] == 3) {
            /* Get the courier data */
            $courier = $this->courier->getByUserId($userRole['user_id']);

            if ($courier['is_active'] == '0') {
                return false;
            } else {
                return JWTAuth::attempt($credentials);
            }
        }

        return JWTAuth::attempt($credentials);
    }
}