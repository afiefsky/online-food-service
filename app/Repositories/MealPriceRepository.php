<?php
namespace OFS\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IMealPriceRepository;
use OFS\Entities\MealPrice;

class MealPriceRepository extends AbstractRepository implements IMealPriceRepository
{
    public function __construct(Application $app, MealPrice $model)
    {
        parent::__construct($app, $model);
    }
}