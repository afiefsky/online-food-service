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


}