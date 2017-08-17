<?php
namespace OFS\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IMealRepository;
use OFS\Entities\Meal;
use OFS\Entities\MealPrice;

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
        $meals = $this->with(['type', 'vendor', 'price'])->all();

        $price = Meal::with('price')->where('vendor_id', $vendor_id)->get();

        return $price;
    }

    public function getOne($meal_id)
    {
        $meal = $this->with('vendor')->with('price')->andWhere('id', $meal_id)->all();

        return $meal;
    }
}