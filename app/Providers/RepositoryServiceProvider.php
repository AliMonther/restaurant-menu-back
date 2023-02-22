<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Config;
use App\Models\Discount;
use App\Models\Item;
use App\Models\Menu;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\ConfigRepository;
use App\Repositories\DiscountRepository;
use App\Repositories\ItemRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(UserRepository::class, function($app){

            return new UserRepository(new User());
        });

        $this->app->singleton(MenuRepository::class, function($app){
            return new MenuRepository(new Menu());
        });

        $this->app->singleton(CategoryRepository::class, function($app){
            return new CategoryRepository(new Category());
        });

        $this->app->singleton(ItemRepository::class, function($app){
            return new ItemRepository(new Item());
        });

        $this->app->singleton(DiscountRepository::class, function($app){
            return new DiscountRepository(new Discount());
        });

        $this->app->singleton(ConfigRepository::class, function($app){
            return new ConfigRepository(new Config());
        });


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
