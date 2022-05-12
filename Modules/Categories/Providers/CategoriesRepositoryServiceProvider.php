<?php

namespace Modules\Categories\Providers;

use Modules\Categories\Repositories\CategoryRepository;
use Modules\Categories\Contracts\CategoryContract;
use Illuminate\Support\ServiceProvider;

class CategoriesRepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
      CategoryContract::class       => CategoryRepository::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
