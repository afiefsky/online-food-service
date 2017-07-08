<?php
namespace OFS\Contracts\Repositories;

use Illuminate\Container\Container;
use Prettus\Repository\Contracts\RepositoryInterface;
use OFS\Entities\MealPrice;

interface IMealPriceRepository extends RepositoryInterface
{
    public function __construct(Container $app, MealPrice $model);
}