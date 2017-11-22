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
        \App\Resume::class => \App\Policies\ResumePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('acceptable_date', 'App\Policies\DateVerification@withinLastMonth');

        Gate::define('application_date', 'App\Policies\DateVerification@acceptableRange');

        Gate::define('interview_date', 'App\Policies\DateVerification@withinMonth');

        Gate::define('offers_dates', 'App\Policies\DateVerification@offersPolicy');
    }
}
