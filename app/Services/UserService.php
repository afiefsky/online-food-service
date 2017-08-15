<?php

namespace OFS\Services;

use OFS\Contracts\Repositories\IUserRepository;

class UserService {

    private $user;

    /**
     * UserService constructor.
     * @param IUserRepository $user
     */
    function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function userIndex()
    {
        $users = $this->user->userIndex();
        return $users;
    }

    /**
     * @return array
     */
    public function customerIndex()
    {
        $customers = $this->user->customerIndex();
        return $customers;
    }

    /**
     * @return array
     */
    public function courierIndex()
    {
        $couriers = $this->user->courierIndex();
        return $couriers;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function userIndexByVendorId($id)
    {
        $users = $this->user->userIndexByVendorId($id);

        return $users;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCustomerById($id)
    {
        $customer = $this->user->findCustomerById($id);

        return $customer;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function findCustomerByKeyword($keyword)
    {
        $customer = $this->user->findCustomerByKeyword($keyword);

        return $customer;
    }

    /**
     * @param $data
     * @param $avatar_url
     * @return mixed
     */
    public function create($data, $avatar_url)
    {
        $user = $this->user->createUser($data, $avatar_url);

        return $user;
    }

    public function update($data, $id)
    {
        $user = $this->user->updateUser($data, $id);

        return $user;
    }

    public function updateCourier($data, $id)
    {
        $user = $this->user->updateCourier($data, $id);

        return $user;
    }

    public function getUserById($id)
    {
        $user = $this->user->getUserById($id);

        return $user;
    }

    public function getByEmail($email)
    {
        $user = $this->user->getByEmail($email);

        return $user;
    }
}