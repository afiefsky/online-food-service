<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\ICustomerRepository;

class CustomerService {
    private $customer;

    /**
     * CustomerService constructor.
     * @param ICustomerRepository $customer
     */
    function __construct(ICustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    public function create($id)
    {
        $customer = $this->customer->createCustomer($id);

        return $customer;
    }
}