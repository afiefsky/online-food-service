<?php
namespace OFS\Repositories;

use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IUserRoleRepository;
use OFS\Entities\UserRole;

class UserRoleRepository extends AbstractRepository implements IUserRoleRepository
{
    function __construct(Application $app, UserRole $model)
    {
        parent::__construct($app, $model);
    }

    /**
     * @param $user_id
     * @param $role_id
     * @return bool
     */
    public function createUser($user_id, $role_id)
    {
        $this->create([
            'user_id' => $user_id,
            'role_id' => $role_id
        ]);

        return true;
    }
}