<?php

namespace App\Providers;

use App\Models\User\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            Permission::get()->map(function ($permission){
                Gate::define($permission->name,function ($user) use ($permission){
                    return $user->hasPermissionTo($permission);
                });
            });
        }catch (\Exception $e){
            report($e);
            return false;
        }

    }
}
