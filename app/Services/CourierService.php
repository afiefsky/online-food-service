<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\ICourierRepository;

class CourierService {
    private $courier;

    function __construct(ICourierRepository $courier)
    {
        $this->courier = $courier;
    }

    public function create($id)
    {
        $courier = $this->courier->createCourier($id);

        return $courier;
    }

    public function get($id)
    {
        $courier = $this->courier->get($id);

        return $courier;
    }
}