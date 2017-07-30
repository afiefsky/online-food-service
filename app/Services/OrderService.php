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

    /**
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        try {
            $order = $this->order->createOrder($data);

            if ($order) {
                return $order;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
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