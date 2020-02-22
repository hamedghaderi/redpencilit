<?php

namespace App\Providers;

use App\Observers\ReplyObserver;
use App\Observers\TicketObserver;
use App\Reply;
use App\Ticket;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use KgBot\LaravelLocalization\Facades\ExportLocalizations;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        View::composer('*', function ($view) {
            return $view->with([
                'messages' => ExportLocalizations::export()->toFlat(),
            ]);
        });
        
        Ticket::observe(TicketObserver::class);
        
        Reply::observe(ReplyObserver::class);
    }
}
