<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\UserVendor;

interface IUserVendorRepository extends RepositoryInterface
{
    /**
     * IUserVendorRepository constructor.
     * @param Container $app
     * @param UserVendor $model
     */
    public function __construct(Container $app, UserVendor $model);

    /**
     * @param $user_id
     * @param $vendor_id
     * @return mixed
     */
    public function createUserVendor($user_id, $vendor_id);
}