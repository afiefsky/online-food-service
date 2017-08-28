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

    public function index()
    {
        $orders = $this->order->index();

        return $this->responseJson($orders, 200);
    }

    public function getByVendor($vendor_id)
    {
        $orders = $this->order->getByVendor($vendor_id);

        return $this->responseJson($orders, 200);
    }

    public function newestOrder()
    {
        $orders = $this->order->newestOrder();
        
        return $this->responseJson($orders, 200);
    }

    public function get($user_id)
    {
        $orders = $this->order->get($user_id);

        return $this->responseJson($orders, 200);
    }

    public function getForCourier($courier_id)
    {
        $orders = $this->order->getForCourier($courier_id);

        return $this->responseJson($orders, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $inputs = $request->only(['user_id', 'customer_id', 'courier_id', 'meal_id', 'qty', 'tariff', 'notes', 'delivery_status', 'total']);

        $inputs['total_converted'] = str_replace([".", ","], "", $inputs['total']);

        $order = $this->order->create($inputs);

        if ($order) {
            return $this->responseJson("Order has been submitted", 200);
        }

        return $this->responseJson([], 400);
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
