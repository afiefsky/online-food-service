<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

/** @var Dingo\Api\Routing\Router $api */
$api->version('v1', function($api) {

    /**
     * Hello World
     * @var Dingo\Api\Routing\Router $api
     */
    $api->get('hello', function() {
        return "Hello World";
    });

    $api->group([ 'namespace' => 'OFS\Http\Controllers\API'], function() use ($api) {
        // Root API
        $api->get('/', 'APIController@info');
        $api->get('info', 'APIController@info');
        $api->post('login', 'AuthenticationController@login');

        // User With JWT Auth
        $api->group(['prefix' => 'user', 'middleware' => 'jwt.auth'], function() use ($api) {
            $api->get('/', 'UserController@userIndex');
            $api->get('index', 'UserController@userIndex');
            $api->get('vendor/{vendor_id}', 'UserController@userIndexByVendorId');
            $api->get('vendor/{vendor_id}/index', 'UserController@userIndexByVendorId');

            // Customer
            $api->get('customer/', 'UserController@customerIndex');
            $api->get('customer/index', 'UserController@customerIndex');
            $api->get('customer/{customer_id}', 'UserController@findCustomerById');
            $api->post('customer/search', 'UserController@findCustomerByKeyword');

            // Courier
            $api->get('courier/', 'UserController@courierIndex');
            $api->get('courier/index', 'UserController@courierIndex');
            $api->post('courier/create', 'UserController@createCourier');
        });

        // User Without JWT Auth
        $api->group(['prefix' => 'user'], function() use ($api) {
            $api->post('customer/create', 'UserController@createCustomer');
        });

        // Meal With JWT Auth
        $api->group(['prefix' => 'meal', 'middleware' => 'jwt.auth'], function() use ($api) {
            $api->post('create', 'MealController@create');
        });

        // Vendor Without JWT Auth
        $api->group(['prefix' => 'vendor'], function() use ($api) {
            $api->post('create', 'UserController@createVendor');
        });

    });
});
