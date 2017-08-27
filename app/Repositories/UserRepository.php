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
        $users = $this->with('category')->all()->toArray();
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
        $couriers = $this->with('courier')->with('category')->whereHas('courier', function($q) use ($i) {
            /* Empty */
        })->all()->toArray();

        return $couriers;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function userIndexByVendorId($id)
    {
        $users = $this->with('vendor')->with('category')->whereHas('vendor', function($q) use ($id)
        {
            $q->where('vendors.id', $id);
        })->all()->toArray();

        return $users;
    }

    public function getUserById($id)
    {
        $user = $this->with('vendor')->with('category')->with('customer')->with('courier')->where('id', $id)->first()->toArray();

        return $user;
    }

    /**
     * @param $id
     * @return string
     */
    public function findCustomerById($id)
    {
        $customer = $this->with('category')->whereHas('customer', function($q) use ($id) {
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
//        try {
            $user = $this->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'birthplace' => $data['birthplace'],
                'birthdate' => $data['birthdate'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'avatar_url' => $data['avatar'],
                'address' => $data['address'],
                'category_id' => $data['category_id'],
                'category_number' => $data['category_number']
            ]);

            return $user->toArray();
//        } catch (\Exception $e) {
//            return false;
//        }
    }

    public function updateUser($data, $id)
    {
        $user = $this->with(['category', 'customer'])->whereHas('customer', function($q) use ($id) {
            $q->where('users_customers.id', $id);
        })->first()->toArray();

        // first_name
        if ($data['first_name'] == null) {
            $data['first_name'] = $user['first_name'];
        }

        // last_name
        if ($data['last_name'] == null) {
            $data['last_name'] = $user['last_name'];
        }

        // email
        if ($data['email'] == null) {
            $data['email'] = $user['email'];
        }

        // password
        if ($data['password'] == null) {
            $data['password'] = $user['password'];
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        // phone
        if ($data['phone'] == null) {
            $data['phone'] = $user['phone'];
        }

        // avatar
        if ($data['avatar'] == null) {
            $data['avatar_url'] = $user['avatar_url'];
        }

        // category_id
        if ($data['category_id'] == null) {
            $data['category_id'] = $user['category_id'];
        }

        // category_number
        if ($data['category_number'] == null) {
            $data['category_number'] = $user['category_number'];
        }

        // birthplace
        if ($data['birthplace'] == null) {
            $data['birthplace'] = $user['birthplace'];
        }

        // birthdate
        if ($data['birthdate'] == null) {
            $data['birthdate'] = $user['birthdate'];
        }

        $source = [
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'],
            'password'          => $data['password'],
            'phone'             => $data['phone'],
            'avatar_url'        => $data['avatar_url'],
            'category_id'       => $data['category_id'],
            'category_number'   => $data['category_number'],
            'birthplace'        => $data['birthplace'],
            'birthdate'         => $data['birthdate']
        ];

        $result = $this->update($source, $user['id']);

        return 1;
    }

    public function updateCourier($data, $id)
    {
        $user = $this->with(['category', 'courier'])->whereHas('courier', function($q) use ($id) {
            $q->where('users_couriers.id', $id);
        })->first()->toArray();

        if ($data['avatar'] == null) {
            $data['avatar_url'] = $user['avatar_url'];
        } else {

        }

        if ($data['password'] == null) {
            $data['password'] = $user['password'];
        } else {

        }

        $source = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'avatar_url' => $data['avatar_url'],
            'category_id' => $data['category_id'],
            'category_number' => $data['category_number'],
            'birthplace' => $data['birthplace'],
            'birthdate' => $data['birthdate']
        ];

        $result = $this->update($source, $user['id']);

        return 1;
    }

    public function getByEmail($email)
    {
        $user = $this->with('customer')->with('courier')->where('email', $email)->first()->toArray();

        return $user;
    }
}