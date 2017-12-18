<?php

namespace App\Providers;

use App\Status;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer(['projects.form','tasks.form','projects.index','tasks.index'], function ($view) {
            $view->with(['statuses' => Status::all()]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
