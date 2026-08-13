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
        Gate::define('isAdmin', fn ($user) => $user->hasRole('admin'));
        Gate::define('isUser', fn ($user) => $user->hasRole('user'));
        Gate::define('isPelayanan', fn ($user) => $user->hasRole('pelayanan'));
        Gate::define('isKredit', fn ($user) => $user->hasRole('kredit'));
        Gate::define('isAK', fn ($user) => $user->hasRole('akunting'));
        Gate::define('isUM', fn ($user) => $user->hasRole('umumpst'));
        Gate::define('isBisnis', fn ($user) => $user->hasRole('bisnis'));
        Gate::define('isSekdir', fn ($user) => $user->hasRole('sekdir'));
        Gate::define('isSkai', fn ($user) => $user->hasRole('skai'));
        Gate::define('isSdm', fn ($user) => $user->hasRole('sdm'));
        Gate::define('isPpk', fn ($user) => $user->hasRole('ppk'));
        Gate::define('isCs', fn ($user) => $user->hasRole('cs'));
        Gate::define('isTeller', fn ($user) => $user->hasRole('teller'));
    }
}
