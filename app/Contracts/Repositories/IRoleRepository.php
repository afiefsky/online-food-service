<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\Role;

interface IRoleRepository extends RepositoryInterface
{
    /**
     * IRoleRepository constructor.
     * @param Container $app
     * @param Role $model
     */
    function __construct(Container $app, Role $model);
}