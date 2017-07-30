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

    public function createOrder($data)
    {
        try {
            $order = $this->create([
                'customer_id' => $data['customer_id'],
                'courier_id' => $data['courier_id'],
                'distance_took' => $data['distance_took'],
                'tariff_distance_id' => $data['tariff_distance_id'],
                'delivery_status' => $data['delivery_status']
            ]);

            if ($order) {
                return $order->toArray();
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function confirmOrder($data)
    {
        try {
            $order = $this->update([
                'delivery_status' => $data['delivery_status']
            ], $data['id']);

            if ($order) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}