<?php

namespace Modules\Products\Providers;

use Modules\Products\Contracts\AttributeContract;
use Modules\Products\Contracts\BrandContract;
use Modules\Products\Contracts\ProductContract;
use Modules\Products\Repositories\AttributeRepository;
use Modules\Products\Repositories\BrandRepository;
use Modules\Products\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductsRepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        AttributeContract::class      => AttributeRepository::class,
        BrandContract::class          => BrandRepository::class,
        ProductContract::class        => ProductRepository::class,
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
