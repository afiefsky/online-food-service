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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $inputs = $request->only(['customer_id', 'courier_id', 'distance_took', 'tariff_distance_id', 'delivery_status']);

        try {
            $order = $this->order->create($inputs);

            if ($order) {
                return $this->responseJson("Order has been submitted", 200);
            }

            return $this->responseJson([], 400);
        } catch (\Exception $e) {
            return $this->responseJson([], 400);
        }
    }

    public function confirm($order_id, Request $request)
    {
        try {
            $inputs = $request->only(['delivery_status']);
            $inputs['id'] = $order_id;

            $order = $this->order->confirm($inputs);
            if ($order) {
                return $this->responseJson("Success!!", 200);
            }
            return $this->responseJson([], 400);
        } catch (\Exception $e) {
            return $this->responseJson([], 400);
        }
    }
}
