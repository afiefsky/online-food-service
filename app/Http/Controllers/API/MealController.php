<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use OFS\Services\MealService;
use Intervention\Image\ImageManagerStatic as Image;

class MealController extends APIController {

    private $meal;

    /**
     * MealController constructor.
     * @param MealService $meal
     */
    public function __construct(MealService $meal)
    {
        $this->meal = $meal;
    }

    public function create(Request $request)
    {
        try {
            $inputs = $request->only(['display_name', 'img_url', 'vendor_id', 'meal_type_id', 'is_available']);
            $inputs['name'] = str_replace(' ', '_', strtolower($inputs['display_name']));

            $this->meal->create($inputs);

            return $this->responseJson($inputs);
        } catch (\Exception $e) {
            return $this->responseJson($e->getMessage(), 400);
        }
    }
}