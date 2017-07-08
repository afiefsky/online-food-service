<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\UserRole;

interface IUserRoleRepository extends RepositoryInterface
{
    /**
     * IUserRoleRepository constructor.
     * @param Container $app
     * @param UserRole $model
     */
    public function __construct(Container $app, UserRole $model);

    /**
     * @param $user_id
     * @param $role_id
     * @return mixed
     */
    public function createUser($user_id, $role_id);
}