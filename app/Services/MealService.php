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

    public function create($data)
    {
        $this->meal->createMeal($data);

        return true;
    }
}