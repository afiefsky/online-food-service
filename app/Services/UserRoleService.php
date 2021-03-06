<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IUserRoleRepository;

class UserRoleService {
    private $userRole;

    /**
     * UserRoleService constructor.
     * @param IUserRoleRepository $userRole
     */
    public function __construct(IUserRoleRepository $userRole)
    {
        $this->userRole = $userRole;
    }

    public function create($user_id, $role_id)
    {
        $data = $this->userRole->createUser($user_id, $role_id);

        return 1;
    }
}