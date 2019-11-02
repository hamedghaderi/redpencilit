<?php

namespace App\Providers;

use App\Permission;
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

        Gate::before(function ($user, $abilities) {
            if ($user->isSuperAdmin())   {
                return true;
            }
        });

        if (! $this->app->environment('testing')) {
            foreach ($this->getPermissions() as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                });
            }
        }
    }
    
    protected function getPermissions()
    {
       return Permission::with('roles')->get();
    }
}
