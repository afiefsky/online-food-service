<?php
namespace OFS\Repositories;

use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IRoleRepository;
use OFS\Entities\Role;

class RoleRepository extends AbstractRepository implements IRoleRepository
{
    function __construct(Application $app, Role $model)
    {
        parent::__construct($app, $model);
    }
}