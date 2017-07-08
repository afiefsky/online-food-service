<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use OFS\Services\CustomerService;
use OFS\Services\UserRoleService;
use OFS\Services\UserService;


class UserController extends APIController {

    private $user;
    private $customer;
    private $userRole;

    /**
     * UserController constructor.
     * @param UserService $user
     * @param CustomerService $customer
     * @param UserRoleService $userRole
     */
    public function __construct(UserService $user, CustomerService $customer, UserRoleService $userRole)
    {
        $this->user = $user;
        $this->customer = $customer;
        $this->userRole = $userRole;
    }

    /**
     * Index of Users
     * @return \Illuminate\Http\JsonResponse
     */
    public function userIndex()
    {
        $users = $this->user->userIndex();

        return $this->responseJson($users, 200);
    }

    /**
     * Index of Customers
     * @return \Illuminate\Http\JsonResponse
     */
    public function customerIndex()
    {
        $customers = $this->user->customerIndex();

        return $this->responseJson($customers, 200);
    }

    /**
     * Index of Couriers
     * @return \Illuminate\Http\JsonResponse
     */
    public function courierIndex()
    {
        $couriers = $this->user->courierIndex();

        return $this->responseJson($couriers, 200);
    }

    /**
     * Index of Users by Vendor ID
     * @param $vendor_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function userIndexByVendorId($vendor_id)
    {
        $users = $this->user->userIndexByVendorId($vendor_id);

        return $this->responseJson($users, 200);
    }

    /**
     * @param $customer_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCustomerById($customer_id)
    {
        try {
            $customer = $this->user->findCustomerById($customer_id);

            if ($customer) {
                return $this->responseJson($customer, 200);
            }
            return $this->responseJson("Customer not found!", 400);
        } catch (\Exception $e) {
            return $this->responseJson($e->getMessage(), 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function findCustomerByKeyword(Request $request)
    {
        $keyword = $request->only(['keyword']);
        try {
            $customer = $this->user->findCustomerByKeyword($keyword['keyword']);

            if ($customer) {
                return $this->responseJson($customer, 200);
            }
            return $this->responseJson("Customer not found!", 400);
        } catch (\Exception $e) {
            return $this->responseJson($e->getMessage(), 400);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCustomer(Request $request)
    {
        // request = first_name, last_name, email, password, phone, avatar_url
        $user = $this->user->create($request->all());
        try {
            if ($user) {
                $this->customer->create($user['id']);
                $this->userRole->create($user['id'], 4);

                return $this->responseJson("User with email [" . $request['email'] . "] has been created!!!", 200);
            }
            return $this->responseJson("User with email [" . $request['email'] . "] is already exists!!!", 400);
        } catch (\Exception $e) {
            return $this->responseJson("User with email [" . $request['email'] . "] is already exists!!!", 400);
        }
    }
}