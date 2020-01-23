<?php

namespace App\Providers;

use App\Repositories\Concrete\Eloquent\ElSaleDal;
use App\Repositories\Interfaces\SaleInterface;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SaleInterface::class, ElSaleDal::class);
    }
}
