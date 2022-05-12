<?php

namespace Modules\Categories\Providers;

use Modules\Categories\Entities\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CategoriesViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.partials.header', function ($view) {
            $view->with('categories',
                Category::orderByRaw('-name ASC')
                    ->where([
                        ['menu','1']
                    ])
                    ->limit(50)
                    ->get()
                    ->nest());
        });
    }
}
