<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use OFS\Services\CustomerService;
use OFS\Services\UserRoleService;
use OFS\Services\UserService;
use OFS\Services\CourierService;
use OFS\Services\VendorService;

class UserController extends APIController {

    private $user;
    private $customer;
    private $userRole;
    private $courier;
    private $vendor;

    /**
     * UserController constructor.
     * @param UserService $user
     * @param CustomerService $customer
     * @param UserRoleService $userRole
     * @param CourierService $courier
     * @param VendorService $vendor
     */
    public function __construct(UserService $user, CustomerService $customer, UserRoleService $userRole, CourierService $courier, VendorService $vendor)
    {
        $this->user = $user;
        $this->customer = $customer;
        $this->userRole = $userRole;
        $this->courier = $courier;
        $this->vendor = $vendor;
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
        try {
            if ($request->hasFile('avatar_url')) {
                $filename = sprintf('%s.%s', md5($request->email), $request->avatar_url->extension());
                $path = sprintf(storage_path('app/avatar/' . $filename));
                $avatar_url = "avatar\\" . $filename;
                Image::make($request->avatar_url->getRealPath())
                    ->fit(220, 220)
                    ->save($path)
                    ->destroy();
            } else {
                $request['avatar_url'] = '';
            }
            $avatar_url = $request->all()['avatar_url'];

            // request = first_name, last_name, email, password, phone, avatar_url
            $user = $this->user->create($request->all(), $avatar_url);

            if ($user) {
                $this->customer->create($user['id']);
                $this->userRole->create($user['id'], 4);

                return $this->responseJson("User customer with email [" . $request['email'] . "] has been created!!!", 200);
            }
            return $this->responseJson([], 400);
        } catch (\Exception $e) {
            return $this->responseJson([], 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCourier(Request $request)
    {

        try {
            if ($request->hasFile('avatar_url')) {
                $filename = sprintf('%s.%s', md5($request->email), $request->avatar_url->extension());
                $path = sprintf(storage_path('app/avatar/' . $filename));
                $avatar_url = "avatar\\" . $filename;
                Image::make($request->avatar_url->getRealPath())
                    ->fit(220, 220)
                    ->save($path)
                    ->destroy();
            } else {
                $request['avatar_url'] = '';
            }
            // request = first_name, last_name, email, password, phone, avatar_url
            $user = $this->user->create($request->all(), $avatar_url);
            if ($user) {
                $this->courier->create($user['id']);
                $this->userRole->create($user['id'], 3);

                return $this->responseJson("User courier with email [" . $request['email'] . "] has been created!!!", 200);
            }
            return $this->responseJson("User courier with email [" . $request['email'] . "] is already exists!!!", 400);
        } catch (\Exception $e) {
            return $this->responseJson("User courier with email [" . $request['email'] . "] is already exists!!!", 400);
        }
    }

    /**
     * @param Request $request
     */
    public function createVendor(Request $request)
    {
        try {
            if ($request->hasFile('logo_url')) {
                $filename = sprintf('%s.%s', md5($request->address), $request->logo_url->extension());
                $path = sprintf(storage_path('app/vendor/' . $filename));
                $request['logo'] = "vendor\\" . bcrypt($filename);
                Image::make($request->logo_url->getRealPath())
                    ->fit(220, 220)
                    ->save($path)
                    ->destroy();
            } else {
                $request['logo'] = '';
            }
            $inputs = $request->only(['name', 'address', 'phone', 'logo_url', 'logo']);

            $vendor = $this->vendor->create($inputs);

            if ($vendor) {
                return $this->responseJson("Vendor with name " . $request['name'] . " has been created!", 200);
            }

            return $this->responseJson([], 400);
        } catch (\Exception $e) {
            return $this->responseJson([], 400);
        }
    }
}