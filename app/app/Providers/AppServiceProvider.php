<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;

use App\Repositories\EventRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\BookingRepository;
use App\Repositories\BookingDiscountRepositoryInterface;
use App\Repositories\BookingDiscountRepository;
use App\Services\EventService;
use App\Services\UserService;
use App\Services\BookingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(BookingDiscountRepositoryInterface::class, BookingDiscountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer')
            );
        });
    }
}
