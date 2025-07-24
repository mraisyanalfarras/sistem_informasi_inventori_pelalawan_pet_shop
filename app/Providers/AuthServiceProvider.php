<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\DataSio;
use App\Policies\UserPolicy;
use App\Policies\DataSioPolicy;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
