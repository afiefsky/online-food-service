<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IRoleRepository;

class RoleService {
    private $role;

    /**
     * RoleService constructor.
     * @param IRoleRepository $role
     */
    function __construct(IRoleRepository $role)
    {
        $this->role = $role;
    }
}