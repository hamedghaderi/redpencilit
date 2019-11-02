<?php

Route::middleware('auth')->group(function () {
    // Services
    Route::get('dashboard/services', 'ServicesController@index')->name('services');
    Route::get('dashboard/services/{service}', 'ServicesController@show');
    Route::post('dashboard/services', 'ServicesController@store')->name('services.store');
    Route::patch('dashboard/services/{service}', 'ServicesController@update')->name('services.update');
    Route::delete('dashboard/services/{service}', 'ServicesController@destroy')->name('services.delete');

    Route::post('/users/{user}/roles', 'UserRolesController@store');

    Route::get('/dashboard/{user}', 'DashboardController@index')->name('dashboard');
    Route::post('/api/users/{user}/avatar', 'AvatarsController@store');
    Route::patch('/dashboard/{user}', 'UsersController@update');
    Route::get('/settings', 'SettingsController@index')->middleware('can:manage-setting');
    Route::post('/settings', 'SettingsController@store')->middleware('can:manage-setting');
    Route::patch('/settings/{setting}', 'SettingsController@update')->middleware('can:manage-setting');
    
    Route::post('/details', 'UserDetailsController@store');
    Route::patch('/users/{user}/details', 'UserDetailsController@update');
    
    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */
    Route::get('/users', 'UsersController@index')->middleware('can:read-users');
    Route::delete('/users/{user}', 'UsersController@destroy')->middleware('can:delete-users');
    
    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */
    Route::get('/users/{user}/orders', 'OrdersController@index');
    Route::post('/users/{user}/orders', 'OrdersController@store')
        ->name('orders')
        ->middleware('must-be-confirmed');
    Route::delete('/users/{user}/orders/{order}', 'OrdersController@destroy')
        ->middleware('must-be-confirmed');
    Route::post('/users/{user}/drafts', 'DraftsController@store')
        ->middleware('must-be-confirmed');
    
    
    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */
    Route::get('/posts/create', 'PostsController@create')->middleware('can:create-posts');
    Route::post('/posts', 'PostsController@store')->middleware('can:create-posts');
    Route::get('/posts/{post}/edit', 'PostsController@edit')->middleware('can:create-posts');
    Route::patch('/posts/{post}', 'PostsController@update')->middleware('can:create-posts');
    Route::delete('/posts/{post}', 'PostsController@destroy')->middleware('can:create-posts');
    
    Route::post('/posts/{post}/favorite', 'FavoritePostsController@store');
    Route::delete('/posts/{post}/disfavor', 'FavoritePostsController@destroy');

    Route::patch('/users/{user}/update-services', 'DocumentServiceController@update');
    Route::delete('/users/{user}/documents', 'DocumentsController@destroy')->middleware('must-be-confirmed');
    Route::post("/post-attachments", 'PostAttachmentsController@store');
    
    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    */
    Route::get('/comments', 'CommentsController@index')->middleware('can:edit-comments');
    Route::delete('/comments/{comment}', 'CommentsController@destroy')->middleware('can:edit-comments');
    Route::post('/comments/{comment}/testimonials', 'TestimonialsController@store')->middleware('can:add-testimonial');
    
});

//Route::get('/roles', 'RolesController@index');
Route::post('/roles', 'RolesController@store');
Route::post('/permissions', 'PermissionsController@store');

Route::get('orders/create', 'OrdersController@create')->name('new-order');
Route::get('/register/emails', 'RegisterConfirmationController@index');
//Route::post('api/documents', 'DocumentsController@store');

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::post('/contacts', 'PagesController@store');
Route::get('/', 'Pagescontroller@homepage');



/*
|--------------------------------------------------------------------------
| Posts
|--------------------------------------------------------------------------
*/
Route::get('/posts', 'PostsController@index');
Route::get('/posts/{post}', 'PostsController@show');

Route::post('/comments', 'CommentsController@store');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

