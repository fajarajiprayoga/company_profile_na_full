<?php

namespace App\Providers;

use App\Models\Footer;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Slider;
use App\Observers\FooterObserver;
use App\Observers\GalleryObserver;
use App\Observers\ProductObserver;
use App\Observers\SliderObserver;
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
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Slider::observe(SliderObserver::class);
        Gallery::observe(GalleryObserver::class);
        Product::observe(ProductObserver::class);
        Footer::observe(FooterObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
