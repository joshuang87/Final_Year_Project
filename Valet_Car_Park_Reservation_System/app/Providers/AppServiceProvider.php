<?php

namespace App\Providers;

use App\Repositories\AdminRepositories\ParkingLotRepository;
use App\Repositories\AdminRepositories\ParkingSpaceRepository;
use App\Repositories\ClientRepositories\CarRepository;
use App\Repositories\ClientRepositories\ClientRepository;
use App\Repositories\ClientRepositories\ReserveRepository;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotRepositoryInterface;
use App\Repositories\Interfaces\AdminInterfaces\ParkingSpaceRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\CarRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ClientInterfaces\ReserveRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Client
        $this->app->bind(ClientRepositoryInterface::class,ClientRepository::class);
        $this->app->bind(CarRepositoryInterface::class,CarRepository::class);
        $this->app->bind(ReserveRepositoryInterface::class,ReserveRepository::class);

        // Admin
        $this->app->bind(ParkingLotRepositoryInterface::class,ParkingLotRepository::class);
        $this->app->bind(ParkingLotCommentRepositoryInterface::class,ParkingLotCommentRepository::class);
        
        $this->app->bind(ParkingSpaceRepositoryInterface::class,ParkingSpaceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
