<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\UserCustomer;

interface ICustomerRepository extends RepositoryInterface
{
    /**
     * ICustomerRepository constructor.
     * @param Container $app
     * @param UserCustomer $model
     */
    function __construct(Container $app, UserCustomer $model);

    public function createCustomer($id);
}