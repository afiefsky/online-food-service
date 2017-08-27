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

    public function index()
    {
        $orders = $this->with(['meal' => function ($q) {
            $q->with('price');
        }])->all()->toArray();

        return $orders;
    }

    public function get($customer_id)
    {
        $orders = $this->with(['meal' => function ($q) {
            $q->with('price');
        }])->where('customer_id', $customer_id)->where('delivery_status', '=', '0')->all()->toArray();

        return $orders;
    }

    /**
     * @param $data
     * @return bool
     */
    public function createOrder($data)
    {
        $order = $this->create([
            'customer_id' => $data['customer_id'],
            'courier_id' => null,
            'meal_id' => $data['meal_id'],
            'qty' => $data['qty'],
            'tariff' => 2000,
            'notes' => $data['notes'],
            'delivery_status' => '0',
            'total' => $data['total_converted']
        ]);

        if ($order) {
            return $order->toArray();
        }
        return false;
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