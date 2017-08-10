<?php

namespace OFS\Http\Controllers\API;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use OFS\Services\AdministratorService;
use OFS\Services\UserRoleService;
use OFS\Services\UserService;
use OFS\Services\UserVendorService;
use OFS\Services\VendorService;

class VendorController extends APIController
{
    /**
     * @var VendorService
     */
    private $vendor;
    private $user;
    private $administrator;
    private $userRole;
    private $userVendor;


    /**
     * VendorController constructor.
     * @param VendorService $vendor
     * @param UserService $user
     * @param AdministratorService $administrator
     * @param UserRoleService $userRole
     * @param UserVendorService $userVendor
     */
    public function __construct(
        VendorService $vendor,
        UserService $user,
        AdministratorService $administrator,
        UserRoleService $userRole,
        UserVendorService $userVendor)
    {
        $this->vendor = $vendor;
        $this->user = $user;
        $this->administrator = $administrator;
        $this->userRole = $userRole;
        $this->userVendor = $userVendor;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $vendors = $this->vendor->index();

            if ($vendors) {
                return $this->responseJson($vendors, 200);
            }
            return $this->responseJson([], 400);
        } catch (\Exception $e) {
            return $this->responseJson($e->getMessage(), 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Image for vendor logo
            if ($request->hasFile('logo_url')) {
                $filename = sprintf('%s.%s', md5($request->email), $request->logo_url->extension());
                $path = sprintf(storage_path('app/vendor/' . $filename));
                $request['logo'] = "vendor\\" . bcrypt($filename);
                Image::make($request->logo_url->getRealPath())
                    ->fit(220, 220)
                    ->save($path)
                    ->destroy();
            } else {
                $request['logo'] = '';
            }
            $inputs['vendor'] = $request->only(['name', 'address', 'phone', 'logo_url', 'logo']);

            // Image for vendor administrator avater
            if ($request->hasFile('avatar_url')) {
                $filename = sprintf('%s.%s', md5($request->email), $request->avatar_url->extension());
                $path = sprintf(storage_path('app\\avatar\\' . $filename));
                $request['avatar'] = "avatar\\" . $filename;
                Image::make($request->avatar_url->getRealPath())
                    ->fit(220, 220)
                    ->save($path)
                    ->destroy();
            } else {
                $request['avatar'] = '';
            }
            $inputs['user'] = $request->only(['first_name', 'last_name', 'email', 'password', 'phone', 'avatar']);

            $vendor = $this->vendor->create($inputs['vendor']);
            $user = $this->user->create($inputs['user'], $request['avatar_url']);
            $adminstrator = $this->administrator->create($user['id']);
            $userRole = $this->userRole->create($user['id'], 2);
            $userVendor = $this->userVendor->create($user['id'], $vendor['id']);

            if ($userVendor) {
                return $this->responseJson("Vendor with name " . $request['name'] . " has been created!", 200);
            }

            return $this->responseJson([], 400);
        } catch (\Exception $e) {
            return $this->responseJson($e->getMessage(), 400);
        }
    }
}