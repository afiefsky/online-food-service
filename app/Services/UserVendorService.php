<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IUserVendorRepository;

class UserVendorService
{
    /**
     * UserVendorService constructor.
     * @param IUserVendorRepository $userVendor
     */
    public function __construct(IUserVendorRepository $userVendor)
    {
        $this->userVendor = $userVendor;
    }

    /**
     * @param $user_id
     * @param $vendor_id
     * @return bool
     */
    public function create($user_id, $vendor_id)
    {
        try {
            $userVendor = $this->userVendor->createUserVendor($user_id, $vendor_id);

            return $userVendor;
        } catch (\Exception $e) {
            return false;
        }
    }
}