<?php

use Illuminate\Support\Facades\Route;

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

// showing home page with view function. this method is called closure routing.
Route::get('/', function () {
    return view('welcome');
});

// authentication routes grouped in vendor folder.
// this is package routing
Auth::routes();


// showing home page with controller 
Route::get('/home', 'HomeController@index')->name('home');


// creating admin routes with security 
// middleware used for security only admin can access this group of routes.
Route::prefix('admin')->namespace('Admin')->middleware('role:admin')->group(function(){

    // user section 
    // see naming conventation below i.e: create for creating a user.
    Route::prefix('user')->group(function(){
        Route::get('/', 'UserController@index');
        Route::get('create', 'UserController@create');
        Route::get('edit/{id}', 'UserController@edit');
        Route::get('delete/{id}', 'UserController@delete');

        Route::post('submit', 'UserController@submit');
        Route::post('update', 'UserController@update');
    });

    // vehicle section 
    // see naming conventation below i.e: create for creating a vehicle.
    Route::prefix('vehicle')->group(function(){
        Route::get('/', 'VehicleController@index');
        Route::get('create', 'VehicleController@create');
        Route::get('edit/{id}', 'VehicleController@edit');
        Route::get('delete/{id}', 'VehicleController@delete');

        Route::post('submit', 'VehicleController@submit');
        Route::post('update', 'VehicleController@update');
    });

    // Driver section 
    // see naming conventation below i.e: create for creating a Driver.
    Route::prefix('driver')->group(function(){
        Route::get('/', 'DriverController@index');
        Route::get('create', 'DriverController@create');
        Route::get('edit/{id}', 'DriverController@edit');
        Route::get('delete/{id}', 'DriverController@delete');

        Route::post('submit', 'DriverController@submit');
        Route::post('update', 'DriverController@update');
    });
});
