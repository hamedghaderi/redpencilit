<?php

Route::redirect('/', '/fa');

Route::group(['prefix' => '{locale}'], function ($locale) {
    Route::middleware('auth')->group(
        function () {
            Route::get('/locale/{lang}', 'RoutesController@show')->name('locale');
            // Services
            Route::get('dashboard/services', 'ServicesController@index')->name('services.index');
            Route::get('dashboard/services/{service}', 'ServicesController@show')->name('services.show');
            Route::post('dashboard/services', 'ServicesController@store')->name('services.store');
            Route::patch('dashboard/services/{service}', 'ServicesController@update')->name('services.update');
            Route::delete('dashboard/services/{service}', 'ServicesController@destroy')->name('services.delete');
            
            Route::post('/users/{user}/roles', 'UserRolesController@store')->name('users.roles.store');
            
            Route::get('/dashboard/{user}', 'DashboardController@index')->name('dashboard');
            Route::post('/api/users/{user}/avatar', 'AvatarsController@store')->name('avatar.store');
            Route::patch('/dashboard/{user}', 'UsersController@update')->name('dashboard.user.update');
            Route::get('/settings', 'SettingsController@index')->name('settings.index')->middleware(
                'can:manage-setting');
            Route::post('/settings', 'SettingsController@store')->name('settings.store')->middleware(
                'can:manage-setting');
            Route::patch('/settings/{setting}', 'SettingsController@update')->name('settings.update')->middleware(
                'can:manage-setting');
            
            Route::post('/details', 'UserDetailsController@store')->name('details.store');
            Route::patch('/users/{user}/details', 'UserDetailsController@update')->name('details.update');
            
            /*
            |--------------------------------------------------------------------------
            | Files
            |--------------------------------------------------------------------------
             */
            Route::get('/tickets/{ticket}/attachment', 'TicketAttachmentsController@show')->name('ticket.attachment');
            
            /*
            |--------------------------------------------------------------------------
            | Tickets
            |--------------------------------------------------------------------------
            */
            Route::get('/tickets', 'TicketsController@index')->name('tickets.index');
            Route::get('/tickets/create', 'TicketsController@create')->name('tickets.create');
            Route::post('/tickets', 'TicketsController@store')->name('tickets.store');
            Route::get('/tickets/{ticket}', 'TicketsController@show')->name('tickets.show');
            
            Route::get('/admin/tickets/{ticket}', 'Admin\\TicketsController@show')->name('admin.tickets.show')
                ->middleware('admin');
            
            /*
            |--------------------------------------------------------------------------
            | Replies
            |--------------------------------------------------------------------------
            */
            Route::post('/tickets/{ticket}/replies', 'RepliesController@store')->name('replies.store');
            Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
            
            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */
            Route::get('/users', 'UsersController@index')->name('admin.users.index')->middleware('can:read-users');
            Route::delete('/users/{user}', 'UsersController@destroy')
                 ->name('admin.users.destroy')
                 ->middleware('can:delete-users');
            
            /*
            |--------------------------------------------------------------------------
            | Orders
            |--------------------------------------------------------------------------
            */
            Route::get('/users/{user}/orders', 'OrdersController@index')->name('users.orders.index');
            Route::post('/users/{user}/orders', 'OrdersController@store')
                 ->name('orders.create')
                 ->middleware('must-be-confirmed');
            Route::delete('/users/{user}/orders/{order}', 'OrdersController@destroy')
                 ->name('orders.destroy')
                 ->middleware('must-be-confirmed');
            Route::post('/users/{user}/drafts', 'DraftsController@store')
                 ->name('drafts.store')
                 ->middleware('must-be-confirmed');
            
            Route::post('/orders/{order}', 'OrderDeliveryController@store')->name('orders.store');
            
            /*
            |--------------------------------------------------------------------------
            | Posts
            |--------------------------------------------------------------------------
            */
            Route::get('/posts/create', 'PostsController@create')->name('posts.create')->middleware(
                ['can:manage-posts']);
            Route::post('/posts', 'PostsController@store')->name('posts.store')->middleware('can:manage-posts');
            Route::get('/posts/{post}/edit', 'PostsController@edit')
                 ->name('posts.edit')
                 ->middleware('can:manage-posts');
            Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update')->middleware(
                'can:manage-posts');
            Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy')->middleware(
                'can:manage-posts');
            
            Route::post('/posts/{post}/favorite', 'FavoritePostsController@store')->name('favorite.store');
            Route::delete('/posts/{post}/disfavor', 'FavoritePostsController@destroy')->name('favorite.destroy');
            
            Route::patch('/users/{user}/update-services', 'DocumentServiceController@update');
            Route::delete('/users/{user}/documents', 'DocumentsController@destroy')->middleware('must-be-confirmed');
            Route::post("/post-attachments", 'PostAttachmentsController@store')->name('attachments.store');
            
            /*
            |--------------------------------------------------------------------------
            | Comments
            |--------------------------------------------------------------------------
            */
            Route::get('/comments', 'CommentsController@index')->name('admin.users.comments')->middleware(
                'can:edit-comments');
            Route::post('/comments/{comment}/testimonials', 'TestimonialsController@store')
                 ->name('testimonials.store')
                 ->middleware('can:manage-posts');
            Route::delete('/testimonials/{testimonial}', 'TestimonialsController@destroy')->name('testimonials.delete');
            Route::delete('/comments/{comment}', 'CommentsController@destroy')
                 ->name('comment.destroy')
                 ->middleware('can:edit-comments');
            
            /*
            |--------------------------------------------------------------------------
            | Pages
            |--------------------------------------------------------------------------
            */
            Route::get('/admin/pages', 'AdminPagesController@index')->name('admin.pages.index')->middleware('admin');
            Route::get('/admin/pages/home', 'AdminPagesController@home')->name('admin.pages.home')->middleware('admin');
            Route::patch('/admin/pages/home', 'AdminPagesController@homeUpdate')->name('admin.home.store')->middleware
            ('admin');
            
            /*
            |--------------------------------------------------------------------------
            | Notifications
            |--------------------------------------------------------------------------
            */
            Route::get('/profile/{user}/notifications', 'UserNotificationsController@index')
                 ->name('notifications.index');
            Route::delete('/profile/{user}/notifications/{notification}', 'UserNotificationsController@destroy')
                ->name('notifications.destroy');
            Route::delete('/profile/{user}/notifications', 'UserNotificationsController@destroyAll')->name('notifications.destroy.all');
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

