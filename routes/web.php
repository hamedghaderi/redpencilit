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


Route::middleware('auth')->group(function () {
    // Services
    Route::get('dashboard/{user}/services', 'ServicesController@index')->name('services');
    Route::get('dashboard/{user}/services/{service}', 'ServicesController@show');
    Route::post('dashboard/{user}/services', 'ServicesController@store')->name('services.store');
    Route::patch('dashboard/{user}/services/{service}', 'ServicesController@update')->name('services.update');
    Route::delete('dashboard/{user}/services/{service}', 'ServicesController@destroy')->name('services.delete');

    Route::post('/users/{user}/roles', 'UserRolesController@store');

    Route::get('/dashboard/{user}', 'DashboardController@index')->name('dashboard');
    Route::post('/api/users/{user}/avatar', 'AvatarsController@store');
    Route::patch('/dashboard/{user}', 'UsersController@update');
    Route::get('/dashboard/{user}/general_settings', 'SettingsController@index')->middleware('can:create,App\Service');
    Route::post('/dashboard/{user}/settings', 'SettingsController@store');
    Route::patch('/dashboard/{user}/settings/{setting}', 'SettingsController@update');


    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */
    Route::post('/users/{user}/orders', 'OrdersController@store')
        ->name('orders')
        ->middleware('must-be-confirmed');
    Route::delete('/users/{user}/orders/{order}', 'OrdersController@destroy')
        ->middleware('must-be-confirmed');
    Route::post('/users/{user}/drafts', 'DraftsController@store')
        ->middleware('must-be-confirmed');

    Route::patch('/users/{user}/update-services', 'DocumentServiceController@update');
    Route::delete('/users/{user}/documents', 'DocumentsController@destroy')->middleware('must-be-confirmed');
});

//Route::get('/roles', 'RolesController@index');
Route::post('/roles', 'RolesController@store');
Route::post('/permissions', 'PermissionsController@store');

Route::get('orders/create', 'OrdersController@create')->name('new-order');
Route::get('/register/emails', 'RegisterConfirmationController@index');
//Route::post('api/documents', 'DocumentsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


