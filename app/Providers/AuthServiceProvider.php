<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        App\Models\Post::class=>App\Policies\PostPolicy::class,
        App\Models\User::class=>App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();
        $this->registerPolicies();
        Gate::define('admin', function($user) {
            // foreach ($user->roles as $role) {
            //     if ($role->name == 'admin') {
            //         return true;
            //     }
            // }
            //admin が定義されてない
            // return false;
            if($user->role === 0){
                return true;
            }
            return false;
        });

        
    }
}
