<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $roles = Role::all();
        View::share('roles', $roles);

        view()->composer('*', function($view)
        {
            if (\Auth::user()) {
                $tahun_ajarans = TahunAjaran::all();
                View::share('tahun_ajarans', $tahun_ajarans);
            }
        });
    }
}
