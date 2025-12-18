<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Organizer;
use App\Observers\EventObserver;
use App\Observers\OrganizerObserver;
use App\Repositories\EventRepository;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\OrganizerRepository;
use App\Repositories\OrganizerRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrganizerRepositoryInterface::class, OrganizerRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Organizer::observe(OrganizerObserver::class);
        Event::observe(EventObserver::class);
    }
}
