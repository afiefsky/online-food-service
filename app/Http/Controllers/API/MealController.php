<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use OFS\Services\MealPriceService;
use OFS\Services\MealService;
use Intervention\Image\ImageManagerStatic as Image;

class MealController extends APIController
{

    private $meal;
    private $price;

    /**
     * MealController constructor.
     * @param MealService $meal
     * @param MealPriceService $price
     */
    public function __construct(MealService $meal, MealPriceService $price)
    {
        $this->meal = $meal;
        $this->price = $price;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $inputs = $request->only(['display_name', 'img_url', 'vendor_id', 'meal_type_id', 'is_available', 'price']);
        try {
            if ($request->hasFile('img_url')) {
                $filename = sprintf('%s.%s', encrypt($request->display_name), $request->img_url->extension());
                $path = sprintf(storage_path('app/meal/' . $filename));
                $img_url = "meal\\" . $filename;
                $inputs['img_url'] = $img_url;
                Image::make($request->img_url->getRealPath())
                ->fit(220, 220)
                ->save($path)
                ->destroy();
            } else {
                $request['img_url'] = '';
            }
            $inputs['name'] = str_replace(' ', '_', strtolower($inputs['display_name']));

            $meal = $this->meal->create($inputs);
            $this->price->create($meal['id'], $inputs['price']);

            return $this->responseJson("Meal " . $inputs['display_name'] . " has been created!!!", 200);
        } catch (\Exception $e) {
            return $this->responseJson($e->getMessage(), 400);
        }
    }

    /* Get by vendor_id */
    public function get($vendor_id)
    {
        $meals = $this->meal->get($vendor_id);

        return $this->responseJson($meals, 200);
    }

    public function getOne($vendor_id, $meal_id)
    {
        $meal = $this->meal->getOne($vendor_id, $meal_id);

        return $this->responseJson($meal, 200);
    }
}
