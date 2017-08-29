<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IOrderRepository;

class OrderService
{
    private $order;

    /**
     * OrderService constructor.
     * @param IOrderRepository $order
     */
    public function __construct(IOrderRepository $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->index();

        return $orders;
    }

    public function getByVendor($vendor_id)
    {
        $orders = $this->order->getByVendor($vendor_id);

        return $orders;
    }

    public function get($user_id)
    {
        $orders = $this->order->get($user_id);

        return $orders;
    }

    public function newestOrder()
    {
        $orders = $this->order->newestOrder();

        return $orders;
    }

    public function getForCourier($courier_id)
    {
        $orders = $this->order->getForCourier($courier_id);

        return $orders;
    }

    /**
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        $order = $this->order->createOrder($data);

        if ($order) {
            return $order;
        }
        return false;
    }

    public function confirm($data)
    {
        try {
            $order = $this->order->confirmOrder($data);

            if ($order) {
                return $order;
            }
            return false;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function confirmCourier($courier_id, $order_id)
    {
        $courier = $this->order->confirmCourier($courier_id, $order_id);

        return $courier;
    }

}
