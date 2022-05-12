<?php

namespace Modules\Orders\Providers;

use Modules\Orders\Contracts\OrderContract;
use Modules\Orders\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class OrdersRepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        OrderContract::class          => OrderRepository::class,
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
