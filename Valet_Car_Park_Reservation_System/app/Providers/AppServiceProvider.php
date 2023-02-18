<?php

namespace App\Providers;

use App\Repositories\CarRepository;
use App\Repositories\ClientRepository;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ReserveRepositoryInterface;
use App\Repositories\ReserveRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientRepositoryInterface::class,ClientRepository::class);
        $this->app->bind(CarRepositoryInterface::class,CarRepository::class);
        $this->app->bind(ReserveRepositoryInterface::class,ReserveRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
