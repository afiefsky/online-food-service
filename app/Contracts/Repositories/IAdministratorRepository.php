<?php

namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\UserAdministrator;

interface IAdministratorRepository extends RepositoryInterface
{
    /**
     * IAdministratorRepository constructor.
     * @param Container $app
     * @param UserAdministrator $model
     */
    public function __construct(Container $app, UserAdministrator $model);
}