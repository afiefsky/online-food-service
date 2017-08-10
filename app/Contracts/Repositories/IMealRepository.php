<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\Meal;

interface IMealRepository extends RepositoryInterface
{
    /**
     * IMealRepository constructor.
     * @param Container $app
     * @param Meal $model
     */
    public function __construct(Container $app, Meal $model);

    /**
     * @param $data
     * @return mixed
     */
    public function createMeal($data);

    public function get($vendor_id);

    public function getOne($vendor_id, $meal_id);
}