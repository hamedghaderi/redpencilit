<?php

namespace App\Providers;

use App\Policies\ServicePolicy;
use App\Policies\SettingPolicy;
use App\Service;
use App\Setting;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Service::class => ServicePolicy::class,
        Setting::class => SettingPolicy::class
    ];
    
    
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::before(function ($user) {
            if ($user->hasRole('super-admin') || $user->hasRole('support')) {
                return true;
            }
        });
        
        Gate::define('manage-posts', function ($user) {
            return $user->hasRole('author') ? true : false;
        });
    }
}
