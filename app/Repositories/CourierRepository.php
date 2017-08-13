<?php
namespace OFS\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\ICourierRepository;
use OFS\Entities\UserCourier;

class CourierRepository extends AbstractRepository implements ICourierRepository
{
    /**
     * CourierRepository constructor.
     * @param Application $app
     * @param UserCourier $model
     */
    public function __construct(Application $app, UserCourier $model)
    {
        parent::__construct($app, $model);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function createCourier($id)
    {
        $courier = $this->create([
            'user_id' => $id,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $courier;
    }

    /* Should be documented */
    public function get($id)
    {
        $courier = $this->with(['user' => function ($q) use($id) {
            $q->with('category');
        }])->where('id', $id)->first();

        return $courier->toArray();
    }
}