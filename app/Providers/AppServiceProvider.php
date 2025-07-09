<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MainCategory;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share main categories with all views
        View::composer('*', function ($view) {
            $mainCategories = MainCategory::where('is_active', true)
                ->orderBy('name')
                ->get();
            $view->with('mainCategories', $mainCategories);
        });
    }
}
