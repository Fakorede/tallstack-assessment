<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-staff', function (User $user) {
            return $user->role->id === Role::Admin;
        });

        Gate::define('export-staff-data', function (User $user) {
            return $user->role->id === Role::Admin;
        });

        Gate::define('add-patient', function (User $user) {
            return (
                $user->role->id === Role::Admin ||
                $user->role->id === Role::Nurse ||
                $user->role->id === Role::Doctor
            );
        });

        Gate::define('export-patient-data', function (User $user) {
            return (
                $user->role->id === Role::Admin ||
                $user->role->id === Role::Nurse ||
                $user->role->id === Role::Doctor
            );
        });
    }
}
