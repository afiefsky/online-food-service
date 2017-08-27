<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\ICourierRepository;

class CourierService
{
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
        try {
            $courier = $this->courier->get($id);

            if ($courier) {
                return $courier;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getByUserId($user_id)
    {
        $courier = $this->courier->getByUserId($user_id);

        return $courier;
    }

    public function deactivate($id)
    {
        $courier = $this->courier->deactivate($id);

        return $courier;
    }

    public function activate($id)
    {
        $courier = $this->courier->activate($id);

        return $courier;
    }
}