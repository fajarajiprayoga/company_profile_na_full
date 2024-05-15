<?php

namespace App\Providers;

use App\Models\Type;
use App\Observers\TypeObserver;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label('Profile')
                    ->url(route('filament.admin.auth.profile'))
                    ->icon('heroicon-s-cog'),
                // ...
            ]);
        });

        FilamentAsset::register([
            Js::make('custom-script', asset('assets/filament/custom.js')),
        ]);

        /**
         * Register observer when default laravel not work
         */
        Type::observe(TypeObserver::class);
    }
}
