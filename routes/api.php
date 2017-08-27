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
//            $api->get('vendor/{vendor_id}/index', 'UserController@userIndexByVendorId');

            $api->get('{user_id}', 'UserController@getUserById');

            // Customer
            $api->get('customer/', 'UserController@customerIndex');
            $api->get('customer/index', 'UserController@customerIndex');
            $api->get('customer/{customer_id}', 'UserController@findCustomerById');

            $api->post('customer/search', 'UserController@findCustomerByKeyword');
        });

        // User Without JWT Auth
        $api->group(['prefix' => 'user'], function() use ($api) {
            $api->post('customer/create', 'UserController@createCustomer');
            $api->post('courier/create', 'UserController@createCourier');

            // Courier
            $api->get('courier/', 'UserController@courierIndex');
            $api->get('courier/index', 'UserController@courierIndex');
            $api->get('courier/{courier_id}', 'UserController@getCourier');
            /* Update Courier */
            $api->post('courier/update/{courier_id}', 'UserController@updateCourier');

            /* Edit */
            $api->put('customer/update/{customer_id}', 'UserController@updateCustomer');

            /* Activate & Deactivate Courier */
            $api->put('courier/activate/{courier_id}', 'CourierController@activate');
            $api->put('courier/deactivate/{courier_id}', 'CourierController@deactivate');
        });

        // Meal With JWT Auth
        $api->group(['prefix' => 'meal', 'middleware' => 'jwt.auth'], function() use ($api) {
            $api->post('create', 'MealController@create');
        });

        $api->group(['prefix' => 'meal'], function() use ($api) {
            $url = 'vendor?id={vendor_id}';
            $api->post('create', 'MealController@create');
            $api->get('{meal_id}', 'MealController@getOne');
            $api->get('vendor/id={vendor_id}',
                'MealController@get');

            $api->get('vendor/{vendor_id}',
                'MealController@get');

            $api->get('/', 'MealController@getAll');
        });

        // Vendor Without JWT Auth
        $api->group(['prefix' => 'vendor'], function() use ($api) {
            $api->get('/', 'VendorController@index');
            $api->get('/index', 'VendorController@index');
            $api->post('create', 'VendorController@create');
            /* Get one vendor */
            $api->get('{vendor_id}', 'VendorController@get');
//            $api->get('{vendor_id}/index', 'VendorController@get');
            /**
             * Get all meal based on vendor id
             * param vendor_id
            */

//            $api->get('{vendor_id}/meal/index', 'MealController@get');

        });

        // Order With JWT Auth
        $api->group(['prefix' => 'order', 'middleware' => 'jwt.auth'], function() use ($api) {
            $api->post('create', 'OrderController@create');
            $api->post('confirm/{order_id}', 'OrderController@confirm');
        });

        $api->group(['prefix' => 'order'], function() use ($api) {
            $api->get('/', 'OrderController@index');
            $api->get('/index', 'OrderController@index');
            $api->post('create', 'OrderController@create');
            $api->get('customer/{customer_id}', 'OrderController@get');
        });

    });
});
