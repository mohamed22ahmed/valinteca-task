<?php

namespace App\Providers;

use App\Events\CreateProductEvent;
use App\Events\GetProductsEvent;
use App\Events\UpdateProductEvent;
use App\Listeners\CreateProductInSallaApiListener;
use App\Listeners\GetProductsFromSallaAPiListener;
use App\Listeners\UpdateProductInDBListener;
use App\Listeners\UpdateProductInSallaApiListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        GetProductsEvent::class => [
            GetProductsFromSallaAPiListener::class,
        ],

        CreateProductEvent::class => [
            CreateProductInSallaApiListener::class
        ],

        UpdateProductEvent::class => [
            UpdateProductInDBListener::class,
            UpdateProductInSallaApiListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
