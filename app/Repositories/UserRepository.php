<?php
namespace OFS\Repositories;

use Illuminate\Container\Container as Application;
use OFS\Contracts\Repositories\IUserRepository;
use OFS\Entities\User;

class UserRepository extends AbstractRepository implements IUserRepository
{
    public function __construct(Application $app, User $model)
    {
        parent::__construct($app, $model);
    }

    /**
     * @return mixed
     */
    public function userIndex()
    {
        $users = $this->all()->toArray();
        return $users;
    }

    /**
     * @return mixed
     */
    public function customerIndex()
    {
        $i = 1;
        $customers = $this->with('customer')->whereHas('customer', function($q) use ($i) {/** Empty */})->all()->toArray();
        return $customers;
    }

    /**
     * @return mixed
     */
    public function courierIndex()
    {
        $i = 1;
        $couriers = $this->with('courier')->whereHas('courier', function($q) use ($i) {/** Empty */})->all()->toArray();

        return $couriers;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function userIndexByVendorId($id)
    {
        $users = $this->with('vendor')->whereHas('vendor', function($q) use ($id)
        {
            $q->where('vendors.id', $id);
        })->all()->toArray();

        return $users;
    }

    /**
     * @param $id
     * @return string
     */
    public function findCustomerById($id)
    {
        $customer = $this->whereHas('customer', function($q) use ($id) {
            $q->where('users_customers.id', $id);
        })->first();

        if ($customer) {
            return $customer->toArray();
        }
        return false;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function findCustomerByKeyword($keyword)
    {
        $customer = $this->whereHas('customer', function($q) use ($keyword) {

        })->whereRaw(" (LOWER(first_name) LIKE '%$keyword%' OR LOWER(last_name) LIKE '%$keyword%') ")->with('customer')->all();

        return $customer->toArray();
    }

    /**
     * @param $data
     * @param $avatar_url
     * @return bool|mixed
     */
    public function createUser($data, $avatar_url)
    {
        try {
            $user = $this->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'phone' => $data['phone'],
                'avatar_url' => $data['avatar']
            ]);

            return $user->toArray();
        } catch (\Exception $e) {
            return false;
        }
    }
}