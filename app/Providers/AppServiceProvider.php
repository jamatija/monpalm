<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Venue;
use App\Observers\VenueSlugObserver;

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
        Venue::observe(VenueSlugObserver::class);
    }
}
