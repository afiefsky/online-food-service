<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IMealRepository;

class MealService {

    private $meal;

    /**
     * MealService constructor.
     * @param IMealRepository $meal
     */
    public function __construct(IMealRepository $meal)
    {
        $this->meal = $meal;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $meal = $this->meal->createMeal($data);

        return $meal;
    }

    public function get($vendor_id)
    {
        $meals = $this->meal->get($vendor_id);

        return $meals;
    }

    public function getOne($vendor_id, $meal_id)
    {
        $meal = $this->meal->getOne($vendor_id, $meal_id);

        return $meal;
    }
}