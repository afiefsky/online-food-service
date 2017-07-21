<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IAdministratorRepository;

class AdministratorService
{
    /**
     * AdministratorService constructor.
     * @param IAdministratorRepository $administrator
     */
    public function __construct(IAdministratorRepository $administrator)
    {
        $this->administrator = $administrator;
    }

    public function create($id)
    {
        $administrator = $this->administrator->createAdministrator($id);

        return $administrator;
    }
}