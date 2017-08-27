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
        try {
            $courier = $this->with(['user' => function ($q) use($id) {
                $q->with('category');
            }])->with(['location' => function ($q) use($id) {
                $q->where('is_valid', '=', '1');
            }])->where('id', $id)->first();

            if ($courier) {
                return $courier->toArray();
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getByUserId($user_id)
    {
        $courier = $this->where('user_id', $user_id)->first()->toArray();

        return $courier;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deactivate($id)
    {
        $courier = $this->update(['is_active' => '0'], $id);

        return $courier;
    }

    public function activate($id)
    {
        $courier = $this->update(['is_active' => '1'], $id);

        return $courier;
    }
}