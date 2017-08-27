<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use OFS\Services\CourierService;

class CourierController extends APIController
{
    private $courier;

    public function __construct(CourierService $courier)
    {
        $this->courier = $courier;
    }

    public function deactivate($courier_id)
    {
        $courier = $this->courier->deactivate($courier_id);

        return $this->responseJson(["Courier with id = '".$courier_id."' has been deactivated"], 200);
    }

}