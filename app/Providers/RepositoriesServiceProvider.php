<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\CustomerRepository;
use App\Http\Repositories\CustomerRepositoryInterface;
use App\Http\Repositories\RegisterRepository;
use App\Http\Repositories\RegisterRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
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
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
    }
}
