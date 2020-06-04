<?php

Route::redirect('/', '/fa');

Route::group(['prefix' => '{locale}'], function ($locale) {
    Route::middleware('auth')->group(
        function () {
            Route::get('/locale/{lang}', 'RoutesController@show')->name('locale');
            
            /*
            |--------------------------------------------------------------------------
            | Services
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'dashboard/services'], function () {
                Route::get('/', 'ServicesController@index')->name('services.index');
                Route::get('/{service}', 'ServicesController@show')->name('services.show');
                Route::post('/', 'ServicesController@store')->name('services.store');
                Route::patch('/{service}', 'ServicesController@update')->name('services.update');
                Route::delete('/{service}', 'ServicesController@destroy')->name('services.delete');
            });
            
            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => '/dashboard'], function () {
                Route::get('/{user}', 'DashboardController@index')->name('dashboard');
                Route::patch('/{user}', 'UsersController@update')->name('dashboard.user.update');
            });
            
            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'settings'], function () {
                Route::get('/', 'SettingsController@index')->name('settings.index')->middleware('can:manage-setting');
                Route::post('/', 'SettingsController@store')->name('settings.store')->middleware('can:manage-setting');
                Route::patch('/{setting}', 'SettingsController@update')
                     ->name('settings.update')
                     ->middleware('can:manage-setting');
            });
            
            /*
            |--------------------------------------------------------------------------
            | Tickets
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'tickets'], function () {
                Route::get('/', 'TicketsController@index')->name('tickets.index');
                Route::get('/create', 'TicketsController@create')->name('tickets.create');
                Route::post('/', 'TicketsController@store')->name('tickets.store');
                Route::get('/{ticket}', 'TicketsController@show')->name('tickets.show');
                Route::get('/{ticket}/attachment', 'TicketAttachmentsController@show')->name('ticket.attachment');
                
                Route::post('/{ticket}/replies', 'RepliesController@store')->name('replies.store');
            });
            
            Route::post('/details', 'UserDetailsController@store')->name('details.store');
            
            Route::post('/api/users/{user}/avatar', 'AvatarsController@store')->name('avatar.store');
            
            Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
            
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', 'UsersController@index')->name('admin.users.index')->middleware('can:read-users');
                Route::delete('/{user}', 'UsersController@destroy')
                     ->name('admin.users.destroy')
                     ->middleware('can:delete-users');
                
                Route::post('/{user}/roles', 'UserRolesController@store')->name('users.roles.store');
                Route::patch('/{user}/details', 'UserDetailsController@update')->name('details.update');
                
                Route::patch('/{user}/update-services', 'DocumentServiceController@update');
                Route::delete('{user}/documents', 'DocumentsController@destroy')->middleware('must-be-confirmed');
               
                /*
                |--------------------------------------------------------------------------
                | Orders
                |--------------------------------------------------------------------------
                */
                Route::group(['prefix' => '{user}/orders'], function () {
                    Route::get('/', 'OrdersController@index')->name('users.orders.index');
                    Route::get('/', 'OrdersController@index')->name('users.orders.index');
                    Route::post('/', 'OrdersController@store')->name('orders.create')->middleware('must-be-confirmed');
                    Route::delete('/{order}', 'OrdersController@destroy')
                         ->name('orders.destroy')
                         ->middleware('must-be-confirmed');
                });
                
                Route::post('{user}/drafts', 'DraftsController@store')
                     ->name('drafts.store')
                     ->middleware('must-be-confirmed');
            });
            
            Route::group(['prefix' => 'orders/{order}'], function () {
                Route::post('/', 'OrderDeliveryController@store')->name('orders.store');
                Route::get('/settled', 'OrderSettleController@show')->name('orders.settled.show');
                
                Route::get('/details/{detail}/attachment', 'OrderAttachmentsController@show')->name('orders.attachment');
            });
            
            
            
            /*
            |--------------------------------------------------------------------------
            | Admin
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'admin'], function () {
                Route::get('tickets/{ticket}', 'Admin\\TicketsController@show')
                     ->name('admin.tickets.show')
                     ->middleware('admin');
                
                Route::get('/orders', 'Admin\\OrdersController@index')->middleware('admin')->name('admin.orders.index');
                Route::get('/orders/{order}', 'Admin\\OrdersController@show')
                     ->middleware('admin')
                     ->name('admin.orders.show');
                Route::post('/orders/{orders}/statuses', 'Admin\\OrderStatusesController@update')
                     ->middleware('admin')
                     ->name('admin.orders.state');
                
                Route::get('pages', 'AdminPagesController@index')->name('admin.pages.index')->middleware('admin');
                Route::get('pages/home', 'AdminPagesController@home')->name('admin.pages.home')->middleware('admin');
                Route::patch('pages/about', 'AdminPagesController@aboutUpdate')
                     ->name('admin.about.store')
                     ->middleware('admin');
                Route::get('pages/contact', 'AdminPagesController@contact')
                     ->name('admin.pages.contact')
                     ->middleware('admin');
                Route::patch('pages/contact', 'AdminPagesController@contactUpdate')
                     ->name('admin.contact.store')
                     ->middleware('admin');
                Route::get('pages/services', 'AdminPagesController@services')
                     ->name('admin.pages.services')
                     ->middleware('admin');
                Route::get('page-service/{pageService}', 'Admin\\PageServicesController@edit')
                    ->name('admin.page-service.edit')
                    ->middleware('admin');
                Route::patch('page-service/{pageService}', 'Admin\\PageServicesController@update')
                     ->name('admin.page-service.update')
                     ->middleware('admin');
                Route::post('page-services', 'Admin\\PageServicesController@store')
                     ->name('admin.page-service.store')
                     ->middleware('admin');
                Route::patch('pages/home', 'AdminPagesController@homeUpdate')
                     ->name('admin.home.store')
                     ->middleware('admin');
            });
            
            /*
            |--------------------------------------------------------------------------
            | Posts
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'posts'], function () {
                Route::get('create', 'PostsController@create')->name('posts.create')->middleware(['can:manage-posts']);
                Route::post('/', 'PostsController@store')->name('posts.store')->middleware('can:manage-posts');
                Route::get('{post}/edit', 'PostsController@edit')->name('posts.edit')->middleware('can:manage-posts');
                Route::patch('{post}', 'PostsController@update')->name('posts.update')->middleware('can:manage-posts');
                Route::delete('{post}', 'PostsController@destroy')
                     ->name('posts.destroy')
                     ->middleware('can:manage-posts');
                
                Route::post('{post}/favorite', 'FavoritePostsController@store')->name('favorite.store');
                Route::delete('{post}/disfavor', 'FavoritePostsController@destroy')->name('favorite.destroy');
            });
            
            Route::post("/post-attachments", 'PostAttachmentsController@store')->name('attachments.store');
            
            /*
            |--------------------------------------------------------------------------
            | Comments
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'comments'], function () {
                Route::get('/', 'CommentsController@index')
                     ->name('admin.users.comments')
                     ->middleware('can:edit-comments');
                Route::post('/{comment}/testimonials', 'TestimonialsController@store')
                     ->name('testimonials.store')
                     ->middleware('can:manage-posts');
                Route::delete('/{comment}', 'CommentsController@destroy')
                     ->name('comment.destroy')
                     ->middleware('can:edit-comments');
            });
            
            Route::delete('/testimonials/{testimonial}', 'TestimonialsController@destroy')->name('testimonials.delete');
            
            /*
            |--------------------------------------------------------------------------
            | Notifications
            |--------------------------------------------------------------------------
            */
            Route::group(['prefix' => 'profile/{user}/notifications'], function () {
                Route::get('/', 'UserNotificationsController@index')->name('notifications.index');
                Route::delete('/{notification}', 'UserNotificationsController@destroy')->name('notifications.destroy');
                Route::delete('/', 'UserNotificationsController@destroyAll')->name('notifications.destroy.all');
            });
        });
    
    Route::get('orders/create', 'OrdersController@create')->name('new-order');
    Route::get('/register/emails', 'RegisterConfirmationController@index')->name('register.email.token');
    
    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
    Route::get('/about', 'PagesController@about')->name('about');
    Route::get('/contact', 'PagesController@contact')->name('contact');
    Route::post('/contacts', 'PagesController@store');
    Route::get('/services', 'PagesController@service')->name('pages.services');
    Route::get('/', 'PagesController@homepage')->name('home');
    
    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */
    Route::get('/posts', 'PostsController@index')->name('posts.index');
    Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');
    
    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    */
    Route::post('/comments', 'CommentsController@store')->name('comments.store')->middleware('throttle');
    
    Auth::routes();
    
    Route::namespace('Admin')->prefix('admin/users')->middleware('auth')->group(
        function () {
            Route::patch('{user}/roles', 'UsersController@update')->name('admin.users.patch');
        });
});

Route::get('/order/confirm', 'OrderDeliveryController@confirm')->name('orders.confirm')->middleware('auth');

