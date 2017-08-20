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
}