<?php
namespace OFS\Repositories;

use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IUserVendorRepository;
use OFS\Entities\UserVendor;

class UserVendorRepository extends AbstractRepository implements IUserVendorRepository
{
    /**
     * UserVendorRepository constructor.
     * @param Application $app
     * @param UserVendor $model
     */
    public function __construct(Application $app, UserVendor $model)
    {
        parent::__construct($app, $model);
    }

    /**
     * @param $user_id
     * @param $vendor_id
     * @return bool
     */
    public function createUserVendor($user_id, $vendor_id)
    {
        try {
            $userVendor = $this->create([
                'user_id' => $user_id,
                'vendor_id' => $vendor_id
            ]);

            return $userVendor->toArray();
        } catch (\Exception $e) {
            return false;
        }
    }

}