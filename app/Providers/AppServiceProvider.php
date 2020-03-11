<?php

namespace App\Providers;

use App\Repositories\Event\EloquentEventRepository;
use App\Repositories\Event\IEventRepository;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (app()->environment() === 'production') {
            URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(IEventRepository::class, EloquentEventRepository::class);
    }
}
