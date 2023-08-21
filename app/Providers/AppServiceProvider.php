<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Content\NewsCategory;
use App\Models\Content\ArticleCategory;

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
        Schema::defaultStringLength(191);
		
		    view()->composer('front.layouts.header',function($view){
			$view->with('newsCategories',NewsCategory::where('status',1)->get());
			$view->with('articleCategories',ArticleCategory::where('status',1)->get());
		});

    }
}
