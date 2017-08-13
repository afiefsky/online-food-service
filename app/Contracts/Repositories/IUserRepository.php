<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\User;

interface IUserRepository extends RepositoryInterface
{
    /**
     * IUserRepository constructor.
     * @param Container $app
     * @param User $model
     */
    public function __construct(Container $app, User $model);

    /**
     * @return mixed
     */
    public function userIndex();

    /**
     * @return mixed
     */
    public function customerIndex();

    /**
     * @return mixed
     */
    public function courierIndex();

    /**
     * @param $id
     * @return mixed
     */
    public function userIndexByVendorId($id);

    /**
     * @param $id
     * @return mixed
     */
    public function findCustomerById($id);

    /**
     * @param $keyword
     * @return mixed
     */
    public function findCustomerByKeyword($keyword);

    /**
     * @param $data
     * @param $avatar_url
     * @return mixed
     */
    public function createUser($data, $avatar_url);

    public function updateUser($data, $id);
}