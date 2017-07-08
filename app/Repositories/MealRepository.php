<?php
namespace OFS\Repositories;

use Carbon\Carbon;
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
        $this->create([
            'name' => $data['name'],
            'display_name' => $data['display_name'],
            'img_url' => $data['img_url'],
            'vendor_id' => $data['vendor_id'],
            'meal_type_id' => $data['meal_type_id'],
            'is_available' => $data['is_available'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return true;
    }
}