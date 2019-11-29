<?php

Route::redirect('/', '/fa');

Route::group(['prefix' => '{locale}'], function ($locale) {
    Route::middleware('auth')->group(function () {
        // Services
        Route::get('dashboard/services', 'ServicesController@index')->name('services.index');
        Route::get('dashboard/services/{service}', 'ServicesController@show')->name('services.show');
        Route::post('dashboard/services', 'ServicesController@store')->name('services.store');
        Route::patch('dashboard/services/{service}', 'ServicesController@update')->name('services.update');
        Route::delete('dashboard/services/{service}', 'ServicesController@destroy')->name('services.delete');
        
        Route::post('/users/{user}/roles', 'UserRolesController@store');
        
        Route::get('/dashboard/{user}', 'DashboardController@index')->name('dashboard');
        Route::post('/api/users/{user}/avatar', 'AvatarsController@store');
        Route::patch('/dashboard/{user}', 'UsersController@update')->name('dashboard.user.update');
        Route::get('/settings', 'SettingsController@index')->middleware('can:manage-setting')->name('settings.index');
        Route::post('/settings', 'SettingsController@store')->middleware('can:manage-setting');
        Route::patch('/settings/{setting}', 'SettingsController@update')->middleware('can:manage-setting');
        
        Route::post('/details', 'UserDetailsController@store');
        Route::patch('/users/{user}/details', 'UserDetailsController@update');
        
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        Route::get('/users', 'UsersController@index')->middleware('can:read-users')->name('admin.users.index');
        Route::delete('/users/{user}', 'UsersController@destroy')->middleware('can:delete-users');
        
        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */
        Route::get('/users/{user}/orders', 'OrdersController@index')->name('users.orders.index');
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
        Route::get('/posts/create', 'PostsController@create')->middleware(['can:manage-posts'])->name('posts.create');
        Route::post('/posts', 'PostsController@store')->middleware('can:manage-posts');
        Route::get('/posts/{post}/edit', 'PostsController@edit')->middleware('can:manage-posts');
        Route::patch('/posts/{post}', 'PostsController@update')->middleware('can:manage-posts');
        Route::delete('/posts/{post}', 'PostsController@destroy')->middleware('can:manage-posts');
        
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
        Route::get('/comments', 'CommentsController@index')->middleware('can:edit-comments')->name('admin.users.comments');
        Route::delete('/comments/{comment}', 'CommentsController@destroy')->middleware('can:edit-comments');
        Route::post('/comments/{comment}/testimonials', 'TestimonialsController@store')->middleware('can:add-testimonial');
    });
    
    Route::get('orders/create', 'OrdersController@create')->name('new-order');
    Route::get('/register/emails', 'RegisterConfirmationController@index');
    
    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
    Route::get('/about', 'PagesController@about')->name('about');
    Route::get('/contact', 'PagesController@contact')->name('contact');
    Route::post('/contacts', 'PagesController@store');
    Route::get('/services', 'PagesController@service')->name('pages.services');
    Route::get('/', 'Pagescontroller@homepage')->name('home');
    
    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */
    Route::get('/posts', 'PostsController@index');
    Route::get('/posts/{post}', 'PostsController@show');
    
    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    */
    Route::post('/comments', 'CommentsController@store');
    
    Auth::routes();
    
    Route::namespace('Admin')->prefix('admin/users')->middleware('auth')->group(function () {
        Route::patch('{user}/roles', 'UsersController@update')->name('admin.users.patch');
    });
});
