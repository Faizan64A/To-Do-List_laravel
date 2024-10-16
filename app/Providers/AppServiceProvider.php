<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Interface\ToDoListRepositryInterface;
use App\Repository\ToDoListRepositry;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ToDoListRepositryInterface::class,ToDoListRepositry::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
