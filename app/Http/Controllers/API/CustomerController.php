<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use OFS\Services\CustomerService;

class CustomerController extends APIController {

    private $customer;

    /**
     * CustomerController constructor.
     * @param UserCustomer $customer
     */
    public function __construct(CustomerService $customer)
    {
        $this->customer = $customer;
    }

    public function index()
    {
        return $this->customer->get();
    }

}