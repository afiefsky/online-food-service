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

    /**
     * @param $data
     * @return mixed
     */
    public function createMeal($data)
    {
        $meal = $this->create([
            'name' => $data['name'],
            'display_name' => $data['display_name'],
            'img_url' => $data['img_url'],
            'vendor_id' => $data['vendor_id'],
            'meal_type_id' => $data['meal_type_id'],
            'is_available' => $data['is_available'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $meal;
    }

    public function get($vendor_id)
    {
        $meals = $this->with(['price', 'type', 'vendor'])->where('vendor_id', $vendor_id)->all();

        $price = $this->with('price')->all()->pluck('price');

        return $meals;
    }

    public function getOne($vendor_id, $meal_id)
    {
        $meal = $this->with('vendor')->where('vendor_id', $vendor_id)->andWhere('id', $meal_id)->all();

        return $meal;
    }
}