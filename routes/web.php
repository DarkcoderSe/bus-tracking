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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->namespace('Admin')->middleware('role:admin')->group(function(){
    Route::prefix('user')->group(function(){
        Route::get('/', 'UserController@index');
        Route::get('create', 'UserController@create');
        Route::get('edit/{id}', 'UserController@edit');
        Route::get('delete/{id}', 'UserController@delete');

        Route::post('submit', 'UserController@submit');
        Route::post('update', 'UserController@update');
    });
});
