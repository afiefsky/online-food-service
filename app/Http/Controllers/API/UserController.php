<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use OFS\Services\CustomerService;
use OFS\Services\UserRoleService;
use OFS\Services\UserService;
use OFS\Services\CourierService;
use OFS\Services\UserVendorService;
use OFS\Services\VendorService;
use OFS\Services\AdministratorService;

class UserController extends APIController
{

    private $user;
    private $customer;
    private $userRole;
    private $courier;
    private $vendor;
    private $administrator;
    private $userVendor;

    /**
     * UserController constructor.
     * @param UserService $user
     * @param CustomerService $customer
     * @param UserRoleService $userRole
     * @param CourierService $courier
     * @param VendorService $vendor
     * @param AdministratorService $administrator
     * @param UserVendorService $userVendor
     */
    public function __construct(
        UserService $user,
        CustomerService $customer,
        UserRoleService $userRole,
        CourierService $courier,
        VendorService $vendor,
        AdministratorService $administrator,
        UserVendorService $userVendor
    ) {
        $this->user = $user;
        $this->customer = $customer;
        $this->userRole = $userRole;
        $this->courier = $courier;
        $this->vendor = $vendor;
        $this->administrator = $administrator;
        $this->userVendor = $userVendor;
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

    public function updateUser(Request $request, $id)
    {
        /* Fillable */
        $data = $request->only(['first_name', 'last_name', 'email', 'password', 'gender', 'phone', 'avatar', 'address', 'category_id', 'category_number', 'birthplace', 'birthdate']);

        if ($request->hasFile('avatar')) {
            $filename = sprintf('%s.%s', md5($request->email), $request->avatar->extension());
            $path = sprintf(storage_path('app/avatar/' . $filename));
            $data['avatar_url'] = "avatar\\" . $filename;
            Image::make($request->avatar->getRealPath())
                ->fit(220, 220)
                ->save($path)
                ->destroy();
        } else {
            $data['avatar_url'] = '';
        }

        $user = $this->user->update($data, $id);

        if ($user) {
            return $this->responseJson("Data has been updated!!", 200);
        }
        return $this->responseJson([], 400);
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

    public function getUserById($id)
    {
        $user = $this->user->getUserById($id);

        return $this->responseJson($user, 200);
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
            if ($request->hasFile('avatar')) {
                $filename = sprintf('%s.%s', md5($request->email), $request->avatar_url->extension());
                $path = sprintf(storage_path('app/avatar/' . $filename));
                $avatar_url = "avatar\\" . $filename;
                Image::make($request->avatar_url->getRealPath())
                    ->fit(220, 220)
                    ->save($path)
                    ->destroy();
            } else {
                $request['avatar'] = '';
            }
            $avatar_url = $request->all()['avatar'];

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
//        try {
            if ($request->hasFile('avatar')) {
                $filename = sprintf('%s.%s', md5($request->email), $request->avatar_url->extension());
                $path = sprintf(storage_path('app/avatar/' . $filename));
                $avatar_url = "avatar\\" . $filename;
                Image::make($request->avatar_url->getRealPath())
                    ->fit(220, 220)
                    ->save($path)
                    ->destroy();
            } else {
                $request['avatar'] = '';
            }
            $avatar_url = $request->all()['avatar'];
            // request = first_name, last_name, email, password, phone, avatar_url
            $user = $this->user->create($request->all(), $avatar_url);
            if ($user) {
                $this->courier->create($user['id']);
                $this->userRole->create($user['id'], 3);

                return $this->responseJson("User courier with email [" . $request['email'] . "] has been created!!!", 200);
            }
            return $this->responseJson([], 400);
//        } catch (\Exception $e) {
//            return $this->responseJson([], 400);
//        }
    }

    /**
     * @param $courier_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourier($courier_id)
    {
        try {
            $courier = $this->courier->get($courier_id);

            if ($courier) {
                return $this->responseJson($courier, 200);
            }

            return $this->responseJson([], 400);
        } catch (\Exception $e) {
            return $this->responseJson([], 400);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCustomer(Request $request, $id)
    {
        /* Fillable */
        $data = $request->only(['first_name', 'last_name', 'email', 'password', 'phone', 'avatar', 'address', 'category_id', 'category_number', 'birthplace', 'birthdate']);

        if ($request->hasFile('avatar')) {
            $filename = sprintf('%s.%s', md5($request->email), $request->avatar->extension());
            $path = sprintf(storage_path('app/avatar/' . $filename));
            $data['avatar_url'] = "avatar\\" . $filename;
            Image::make($request->avatar->getRealPath())
                ->fit(220, 220)
                ->save($path)
                ->destroy();
        } else {
            $data['avatar_url'] = '';
        }

        $user = $this->user->update($data, $id);

        if ($user) {
            return $this->responseJson("Data has been updated!!", 200);
        }
        return $this->responseJson([], 400);
    }

    public function updateCourier(Request $request, $id)
    {
        $data = $request->only(['first_name', 'last_name', 'email', 'password', 'phone', 'avatar', 'birthplace', 'birthdate', 'address', 'category_id', 'category_number']);

        if ($request->hasFile('avatar')) {
            $filename = sprintf('%s.%s', md5($request->email), $request->avatar->extension());
            $path = sprintf(storage_path('app/avatar/' . $filename));
            $data['avatar_url'] = "avatar\\" . $filename;
            Image::make($request->avatar->getRealPath())
                ->fit(220, 220)
                ->save($path)
                ->destroy();
        } else {
            $data['avatar_url'] = '';
        }

        $user = $this->user->updateCourier($data, $id);

        if ($user) {
            return $this->responseJson("Data has been updated!!", 200);
        }
        return $this->responseJson([], 400);
    }
}
