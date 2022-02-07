<?php

namespace App\Providers;

use App\Repository\Interfaces\BaseRepositoryInterface;
use App\Repository\Interfaces\FoodRepositoryInterface;
use App\Repository\Interfaces\IngredientRepositoryInterface;
use App\Repository\Interfaces\OrderRepositoryInterface;
use App\Repository\Services\BaseRepository;
use App\Repository\Services\FoodRepository;
use App\Repository\Services\IngredientRepository;
use App\Repository\Services\OrderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BaseRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(FoodRepositoryInterface::class,FoodRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        $this->app->bind(IngredientRepositoryInterface::class,IngredientRepository::class);
    }
}
