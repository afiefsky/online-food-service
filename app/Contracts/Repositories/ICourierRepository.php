<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\UserCourier;

interface ICourierRepository extends RepositoryInterface
{
    /**
     * ICourierRepository constructor.
     * @param Container $app
     * @param UserCourier $model
     */
    function __construct(Container $app, UserCourier $model);

    public function createCourier($id);

    public function get($id);

    public function deactivate($id);
}