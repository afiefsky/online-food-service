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

    public function createMeal($data);
}