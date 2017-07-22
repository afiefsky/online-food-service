<?php

namespace OFS\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use OFS\Contracts\Repositories\IOrderRepository;
use OFS\Entities\Order;

class OrderRepository extends AbstractRepository implements IOrderRepository
{
    /**
     * OrderRepository constructor.
     * @param Application $app
     * @param Order $model
     */
    public function __construct(Application $app, Order $model)
    {
        parent::__construct($app, $model);
    }
}