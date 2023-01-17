<?php

namespace App\Providers;
use App\Models\User;
use App\Models\ProductOrder;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-personal', function (User $user)
        {
            return $user->role_id == '1';
        });

        Gate::define('manage-commerces', function (User $user)
        {
            return $user->role_id == '1';
        });        

        Gate::define('manage-products', function (User $user)
        {
            return $user->role_id == '2';
        });

        Gate::define('manage-orders', function (User $user)
        {
            return $user->role_id == '3';
        });
    }
}
