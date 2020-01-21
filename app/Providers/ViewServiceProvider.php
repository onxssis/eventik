<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewView;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('home.partials.category', function (ViewView $view) {
            $categories = Cache::remember(Category::cacheKey(), env('CACHE_LIFETIME') || 43200, function () {
                return Category::inRandomOrder()->get();
            });

            return $view->with(compact('categories'));
        });
    }
}
