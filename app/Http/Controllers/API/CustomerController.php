<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use OFS\Services\CustomerService;

class CustomerController extends APIController
{
    /**
     * @var CustomerService
     */
    private $customer;

    /**
     * CustomerController constructor.
     * @param CustomerService $customer
     */
    public function __construct(CustomerService $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->customer->get();
    }
}
