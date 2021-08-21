<?php

namespace App\Providers;

use App\Http\Repositories\Event\EventRepository;
use App\Http\Repositories\Event\EventRepositoryContract;
use App\Http\Repositories\Payment\PaymentRepository;
use App\Http\Repositories\Payment\PaymentRepositoryContract;
use App\Http\Services\Frontend\Event\EventService;
use App\Http\Services\Frontend\Event\EventServiceContract;
use App\Http\Services\Frontend\Payment\PaymentService;
use App\Http\Services\Frontend\Payment\PaymentServiceContract;
use Illuminate\Support\DateFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        EventServiceContract::class => EventService::class,
        PaymentServiceContract::class => PaymentService::class,

        EventRepositoryContract::class => EventRepository::class,
        PaymentRepositoryContract::class => PaymentRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        DateFactory::use(\Carbon\CarbonImmutable::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
