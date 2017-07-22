<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// User
Route::get('storage/avatar/{filename}', function ($filename)
{
    return Image::make(storage_path('app\\avatar\\' . $filename))->response();
});

// Meal
Route::get('storage/meal/{filename}', function ($filename)
{
    return Image::make(storage_path('app\\meal\\' . $filename))->response();
});