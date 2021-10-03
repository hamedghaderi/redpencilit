<?php

use App\Http\Controllers\Admin\OrderReplyAttachmentsController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;
use App\Http\Controllers\Admin\OrderStatusesController;
use App\Http\Controllers\Admin\PageServicesController;
use App\Http\Controllers\Admin\TicketsController as AdminTicketsController;
use App\Http\Controllers\Admin\UploadOrderReplyController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\AvatarsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\DocumentServiceController;
use App\Http\Controllers\DraftsController;
use App\Http\Controllers\FavoritePostsController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OrderAttachmentsController;
use App\Http\Controllers\OrderDeliveryController;
use App\Http\Controllers\OrderRepliesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderSettleController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostAttachmentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterConfirmationController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\TicketAttachmentsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserNotificationsController;
use App\Http\Controllers\UserRolesController;
use App\Http\Controllers\UsersController;

Route::prefix(\LaravelLocalization::setLocale())
    ->middleware(["localeSessionRedirect", "localizationRedirect"])
    ->group(function () {
        Route::middleware("auth")->group(function () {
            /*
            |--------------------------------------------------------------------------
            | Services
            |--------------------------------------------------------------------------
            */
            Route::group(["prefix" => "dashboard/services"], function () {
                Route::get("/", [ServicesController::class, "index"])->name(
                    "services.index"
                );
                Route::get("/{service}", [
                    ServicesController::class,
                    "show",
                ])->name("services.show");
                Route::post("/", [ServicesController::class, "store"])->name(
                    "services.store"
                );
                Route::patch("/{service}", [
                    ServicesController::class,
                    "update",
                ])->name("services.update");
                Route::delete("/{service}", [
                    ServicesController::class,
                    "destroy",
                ])->name("services.delete");
            });

            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */
            Route::group(["prefix" => "/dashboard"], function () {
                Route::get("/", [DashboardController::class, "index"])->name(
                    "dashboard"
                );
                Route::patch("/", [UsersController::class, "update"])->name(
                    "dashboard.user.update"
                );
            });

            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */
            Route::group(["prefix" => "settings"], function () {
                Route::get("/", [SettingsController::class, "index"])
                    ->name("settings.index")
                    ->middleware("can:manage-setting");
                Route::post("/", [SettingsController::class, "store"])
                    ->name("settings.store")
                    ->middleware("can:manage-setting");
                Route::patch("/{setting}", [
                    SettingsController::class,
                    "update",
                ])
                    ->name("settings.update")
                    ->middleware("can:manage-setting");
            });

            /*
            |--------------------------------------------------------------------------
            | Tickets
            |--------------------------------------------------------------------------
            */
            Route::group(["prefix" => "tickets"], function () {
                Route::get("/", [TicketsController::class, "index"])->name(
                    "tickets.index"
                );
                Route::get("/create", [
                    TicketsController::class,
                    "create",
                ])->name("tickets.create");
                Route::post("/", [TicketsController::class, "store"])->name(
                    "tickets.store"
                );
                Route::get("/{ticket}", [
                    TicketsController::class,
                    "show",
                ])->name("tickets.show");
                Route::get("/{ticket}/attachment", [
                    TicketAttachmentsController::class,
                    "show",
                ])->name("ticket.attachment");

                Route::post("/{ticket}/replies", [
                    RepliesController::class,
                    "store",
                ])->name("replies.store");
            });

            Route::post("/details", [
                UserDetailsController::class,
                "store",
            ])->name("details.store");

            Route::post("/api/users/{user}/avatar", [
                AvatarsController::class,
                "store",
            ])->name("avatar.store");

            Route::delete("/replies/{reply}", [
                RepliesController::class,
                "destroy",
            ])->name("replies.destroy");

            Route::group(["prefix" => "users"], function () {
                Route::get("/", [UsersController::class, "index"])
                    ->name("admin.users.index")
                    ->middleware("can:read-users");
                Route::delete("/{user}", [UsersController::class, "destroy"])
                    ->name("admin.users.destroy")
                    ->middleware("can:delete-users");

                Route::post("/{user}/roles", [
                    UserRolesController::class,
                    "store",
                ])->name("users.roles.store");
                Route::patch("/{user}/details", [
                    UserDetailsController::class,
                    "update",
                ])->name("details.update");

                Route::patch("/{user}/update-services", [
                    DocumentServiceController::class,
                    "update",
                ]);
                Route::delete("{user}/documents", [
                    DocumentsController::class,
                    "destroy",
                ])->middleware("must-be-confirmed");

                /*
                |--------------------------------------------------------------------------
                | Orders
                |--------------------------------------------------------------------------
                */
                Route::group(["prefix" => "orders"], function () {
                    Route::get("/", [OrdersController::class, "index"])->name(
                        "orders.index"
                    );
                    Route::get("show", [OrdersController::class, "show"])->name(
                        "orders.show"
                    );
                    Route::post("/", [OrdersController::class, "store"])
                        ->name("orders.create")
                        ->middleware("must-be-confirmed");
                    Route::delete("/{order}", [
                        OrdersController::class,
                        "destroy",
                    ])
                        ->name("orders.destroy")
                        ->middleware("must-be-confirmed");
                });

                Route::post("{user}/drafts", [DraftsController::class, "store"])
                    ->name("drafts.store")
                    ->middleware("must-be-confirmed");
            });

            Route::group(["prefix" => "orders/{order}"], function () {
                Route::post("/", [
                    OrderDeliveryController::class,
                    "store",
                ])->name("orders.store");
                Route::get("/settled", [
                    OrderSettleController::class,
                    "show",
                ])->name("orders.settled.show");

                Route::get("/details/{detail}/attachment", [
                    OrderAttachmentsController::class,
                    "show",
                ])->name("orders.attachment");
            });

            Route::get("/order/reply/{reply}/attachments", [
                OrderRepliesController::class,
                "show",
            ])->name("order.reply.attachments");

            /*
            |--------------------------------------------------------------------------
            | Admin
            |--------------------------------------------------------------------------
            */
            Route::group(["prefix" => "admin"], function () {
                Route::get("tickets/{ticket}", [
                    AdminTicketsController::class,
                    "show",
                ])
                    ->name("admin.tickets.show")
                    ->middleware("admin");

                Route::get("/orders", [AdminOrdersController::class, "index"])
                    ->middleware("admin")
                    ->name("admin.orders.index");
                Route::get("/orders/{order}", [
                    AdminOrdersController::class,
                    "show",
                ])
                    ->middleware("admin")
                    ->name("admin.orders.show");
                Route::post("/orders/{orders}/statuses", [
                    OrderStatusesController::class,
                    "show",
                ])
                    ->middleware("admin")
                    ->name("admin.orders.state");

                Route::get("/orders/{order}/upload-completed-articles", [
                    UploadOrderReplyController::class,
                    "create",
                ])
                    ->middleware("admin")
                    ->name("admin.orders.reply");
                Route::post("/orders/{order}/upload-completed-articles", [
                    UploadOrderReplyController::class,
                    "store",
                ])
                    ->middleware("admin")
                    ->name("admin.orders.reply.persist");
                Route::get("/order-replies/{reply}/attachments", [
                    OrderReplyAttachmentsController::class,
                    "show",
                ])
                    ->middleware("admin")
                    ->name("admin.orders.attachments");
                /*
                |--------------------------------------------------------------------------
                |  Admin Pages
                |--------------------------------------------------------------------------
                */
                Route::get("pages", [AdminPagesController::class, "index"])
                    ->name("admin.pages.index")
                    ->middleware("admin");
                Route::get("pages/home", [AdminPagesController::class, "home"])
                    ->name("admin.pages.home")
                    ->middleware("admin");
                Route::get("pages/about", [
                    AdminPagesController::class,
                    "about",
                ])
                    ->name("admin.pages.about")
                    ->middleware("admin");
                Route::patch("pages/about", [
                    AdminPagesController::class,
                    "aboutUpdate",
                ])
                    ->name("admin.about.store")
                    ->middleware("admin");
                Route::get("pages/contact", [
                    AdminPagesController::class,
                    "contact",
                ])
                    ->name("admin.pages.contact")
                    ->middleware("admin");
                Route::patch("pages/contact", [
                    AdminPagesController::class,
                    "contactUpdate",
                ])
                    ->name("admin.contact.store")
                    ->middleware("admin");
                Route::get("pages/services", [
                    AdminPagesController::class,
                    "services",
                ])
                    ->name("admin.pages.services")
                    ->middleware("admin");
                Route::get("page-service/{pageService}", [
                    PageServicesController::class,
                    "edit",
                ])
                    ->name("admin.page-service.edit")
                    ->middleware("admin");
                Route::patch("page-service/{pageService}", [
                    PageServicesController::class,
                    "update",
                ])
                    ->name("admin.page-service.update")
                    ->middleware("admin");
                Route::post("page-services", [
                    PageServicesController::class,
                    "store",
                ])
                    ->name("admin.page-service.store")
                    ->middleware("admin");
                Route::patch("pages/home", [
                    AdminPagesController::class,
                    "homeUpdate",
                ])
                    ->name("admin.home.store")
                    ->middleware("admin");
            });

            /*
            |--------------------------------------------------------------------------
            | Posts
            |--------------------------------------------------------------------------
            */
            Route::group(["prefix" => "posts"], function () {
                Route::get("create", [PostsController::class, "create"])
                    ->name("posts.create")
                    ->middleware(["can:manage-posts"]);
                Route::post("/", [PostsController::class, "store"])
                    ->name("posts.store")
                    ->middleware("can:manage-posts");
                Route::get("{post}/edit", [PostsController::class, "edit"])
                    ->name("posts.edit")
                    ->middleware("can:manage-posts");
                Route::patch("{post}", [PostsController::class, "update"])
                    ->name("posts.update")
                    ->middleware("can:manage-posts");
                Route::delete("{post}", [PostsController::class, "destroy"])
                    ->name("posts.destroy")
                    ->middleware("can:manage-posts");

                Route::post("{post}/favorite", [
                    FavoritePostsController::class,
                    "store",
                ])->name("favorite.store");
                Route::delete("{post}/disfavor", [
                    FavoritePostsController::class,
                    "destroy",
                ])->name("favorite.destroy");
            });

            Route::post("/post-attachments", [
                PostAttachmentsController::class,
                "store",
            ])->name("attachments.store");

            /*
            |--------------------------------------------------------------------------
            | Comments
            |--------------------------------------------------------------------------
            */
            Route::group(["prefix" => "comments"], function () {
                Route::get("/", [CommentsController::class, "index"])
                    ->name("admin.users.comments")
                    ->middleware("can:edit-comments");
                Route::delete("/{comment}", [
                    CommentsController::class,
                    "destroy",
                ])
                    ->name("comment.destroy")
                    ->middleware("can:edit-comments");

                Route::post("/{comment}/testimonials", [
                    TestimonialsController::class,
                    "store",
                ])
                    ->name("testimonials.store")
                    ->middleware("can:manage-posts");
            });

            Route::delete("/testimonials/{testimonial}", [
                TestimonialsController::class,
                "destroy",
            ])->name("testimonials.delete");

            /*
            |--------------------------------------------------------------------------
            | Notifications
            |--------------------------------------------------------------------------
            */
            Route::group(
                ["prefix" => "profile/{user}/notifications"],
                function () {
                    Route::get("/", [
                        UserNotificationsController::class,
                        "index",
                    ])->name("notifications.index");
                    Route::delete("/{notification}", [
                        UserNotificationsController::class,
                        "destroy",
                    ])->name("notifications.destroy");
                    Route::delete("/", [
                        UserNotificationsController::class,
                        "destroyAll",
                    ])->name("notifications.destroy.all");
                }
            );
        });

        Route::get("orders/create", [OrdersController::class, "create"])->name(
            "new-order"
        );
        Route::get("/register/emails", [
            RegisterConfirmationController::class,
            "index",
        ])->name("register.email.token");

        /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
        Route::get("/about", [PagesController::class, "about"])->name("about");
        Route::get("/contact", [PagesController::class, "contact"])->name(
            "contact"
        );
        Route::post("/contacts", [PagesController::class, "store"]);
        Route::get("/services", [PagesController::class, "service"])->name(
            "pages.services"
        );
        Route::get("/", [PagesController::class, "homepage"])->name("home");

        /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */
        Route::get("/posts", [PostsController::class, "index"])->name(
            "posts.index"
        );
        Route::get("/posts/{post}", [PostsController::class, "show"])->name(
            "posts.show"
        );

        /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    */
        Route::post("/comments", [CommentsController::class, "store"])
            ->name("comments.store")
            ->middleware("throttle");

        Auth::routes();

        Route::namespace("Admin")
            ->prefix("admin/users")
            ->middleware("auth")
            ->group(function () {
                Route::patch("{user}/roles", [
                    UsersController::class,
                    "update",
                ])->name("admin.users.patch");
            });
    });

Route::get("/order/confirm", [OrderDeliveryController::class, "confirm"])
    ->name("orders.confirm")
    ->middleware("auth");
