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
            $q->with('price')->with('vendor');
        }])->with(['courier' => function ($q) {
            $q->with('user');
        }])->with(['customer' => function ($q) {
            $q->with('user');
        }])->all()->toArray();

        return $orders;
    }

    public function newestOrder()
    {
        $orders = $this->with('meal')->with('user')->where('delivery_status', '=', '3')->all();

        return $orders;
    }

    public function getByVendor($vendor_id)
    {
        $orders = $this->whereHas('meal', function ($q) use ($vendor_id) {
            $q->where('vendor_id', '=', $vendor_id);
        })->with(['meal' => function ($q) {
            $q->with('price')->with('vendor');
        }])->with(['courier' => function ($q) {
            $q->with('user');
        }])->with(['customer' => function ($q) {
            $q->with('user');
        }])->all()->toArray();

        return $orders;
    }

    public function get($user_id)
    {
        $orders = $this->with(['meal' => function ($q) {
            $q->with('price');
        }])->where('user_id', $user_id)->where('delivery_status', '=', '3')->all()->toArray();

        return $orders;
    }

    public function getForCourier($user_id)
    {
        $orders = $this->with(['customer' => function ($q) {
            $q->with('user');
        }])->with(['meal' => function ($q) {
            $q->with('price');
        }])->where('user_id', $user_id)->all()->toArray();

        return $orders;
    }

    /**
     * @param $data
     * @return bool
     */
    public function createOrder($data)
    {
        $order = $this->create([
            'user_id' => $data['user_id'],
            'courier_id' => null,
            'meal_id' => $data['meal_id'],
            'qty' => $data['qty'],
            'tariff' => 2000,
            'notes' => $data['notes'],
            'delivery_status' => '3', // waiting
            'total' => $data['total_converted']
        ]);

        if ($order) {
            return $order->toArray();
        }
        return false;
    }

    public function confirmOrder($data)
    {
            $order = $this->update([
                'delivery_status' => $data['delivery_status']
            ], $data['id']);

            if ($order) {
                return true;
            }
            return false;
    }
}