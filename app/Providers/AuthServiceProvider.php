<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('all', function ($user) {
            return $user->id === 1 || $user->id !== 1;
        });

        // 管理者判定
        Gate::define('admin', function ($user) {
            return $user->id === 1;
        });

        // 一般判定
        Gate::define('general', function ($user) {
            return $user->id !== 1;
        });
    }
}
