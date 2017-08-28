<?php

namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\Order;

interface IOrderRepository extends RepositoryInterface
{
    /**
     * IOrderRepository constructor.
     * @param Container $app
     * @param Order $model
     */
    public function __construct(Container $app, Order $model);

    public function index();

    public function getByVendor($vendor_id);

    public function get($user_id);

    public function getForCourier($courier_id);

    /**
     * @param $data
     * @return mixed
     */
    public function createOrder($data);

    /**
     * @param $data
     * @return mixed
     */
    public function confirmOrder($data);
}