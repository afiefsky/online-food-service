<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use OFS\Services\OrderService;

class OrderController extends APIController
{
    /**
     * @var OrderService
     */
    private $order;

    /**
     * OrderController constructor.
     * @param OrderService $order
     */
    public function __construct(OrderService $order)
    {
        $this->order = $order;
    }

    public function create(Request $request)
    {
        $inputs = $request->only(['']);
    }
}