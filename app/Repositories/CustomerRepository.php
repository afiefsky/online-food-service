<?php
namespace OFS\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\ICustomerRepository;
use OFS\Entities\UserCustomer;

class CustomerRepository extends AbstractRepository implements ICustomerRepository
{
    public function __construct(Application $app, UserCustomer $model)
    {
        parent::__construct($app, $model);
    }

    public function createCustomer($id)
    {
        $customer = $this->create([
            'user_id' => $id,
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $customer;
    }
}