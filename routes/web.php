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

Route::middleware('auth')->group(function() {
    Route::get('dashboard/{user}/services', 'ServicesController@index');
    Route::post('dashboard/{user}/services', 'ServicesController@store');
    Route::get('dashboard/{user}/services/create', 'ServicesController@create');
    Route::get('/dashboard/{user}', 'DashboardController@index')->name('dashboard');
    Route::post('/api/users/{user}/avatar', 'AvatarsController@store');
});

Route::get('orders/create', 'OrdersController@create');
Route::post('api/documents', 'DocumentsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

