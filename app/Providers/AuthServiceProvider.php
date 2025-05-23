<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        /**
         * Defining the user Roles
         */

        Gate::define('isAdmin', function ($user) {
            // if ($user->isAdmin()) {
            //     return true;
            // }

            // for simplicity
            return $user->type === 'admin';
        });

        Gate::define('isUser', function ($user) {
            // if ($user->isUser()) {
            //     return true;
            // }

            // for simplicity
            return $user->type === 'user';
        });

        Gate::define('isPelayanan', function ($user) {

            return $user->type === 'pelayanan';
        });

        Gate::define('isKredit', function ($user) {

            return $user->type === 'kredit';
        });
        Gate::define('isAK', function ($user) {

            return $user->type === 'akunting';
        });
        Gate::define('isUM', function ($user) {

            return $user->type === 'umumpst';
        });
        Gate::define('isBisnis', function ($user) {

            return $user->type === 'bisnis';
        });
        Gate::define('isSekdir', function ($user) {

            return $user->type === 'sekdir';
        });
        Gate::define('isAK', function ($user) {

            return $user->type === 'akunting';
        });
        Gate::define('isSkai', function ($user) {

            return $user->type === 'skai';
        });
        Gate::define('isSdm', function ($user) {

            return $user->type === 'sdm';
        });
    }
}
