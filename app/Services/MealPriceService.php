<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IMealPriceRepository;

class MealPriceService
{
    private $price;

    /**
     * MealPriceService constructor.
     * @param IMealPriceRepository $price
     */
    public function __construct(IMealPriceRepository $price)
    {
        $this->price = $price;
    }
}