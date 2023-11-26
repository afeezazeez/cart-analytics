<?php

namespace App\Providers;

use App\Interfaces\ICartItemRepository;
use App\Interfaces\ICartRepository;
use App\Interfaces\IOrderRepository;
use App\Interfaces\IProductRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ICartRepository::class, CartRepository::class);
        $this->app->bind(ICartItemRepository::class, CartItemRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
