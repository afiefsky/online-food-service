<?php
namespace OFS\Repositories;

use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IMealRepository;
use OFS\Entities\Meal;

class MealRepository extends AbstractRepository implements IMealRepository
{
    public function __construct(Application $app, Meal $model)
    {
        parent::__construct($app, $model);
    }

    public function createMeal($data)
    {
        return true;
    }
}