<?php
namespace OFS\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IAdministratorRepository;
use OFS\Entities\UserAdministrator;

class AdministratorRepository extends AbstractRepository implements IAdministratorRepository
{
    /**
     * AdministratorRepository constructor.
     * @param Application $app
     * @param UserAdministrator $model
     */
    public function __construct(Application $app, UserAdministrator $model)
    {
        parent::__construct($app, $model);
    }

    public function createAdministrator($id)
    {
        $administrator = $this->create([
            'user_id' => $id,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $administrator;
    }
}