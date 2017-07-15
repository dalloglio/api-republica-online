<?php

namespace App\Providers;

use App\Domains\Ad\Ad;
use App\Domains\User\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'ads' => Ad::class,
            'users' => User::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->singleton(\Faker\Generator::class, function () {
                return \Faker\Factory::create(env('FAKER_LANGUAGE'));
            });
        }
    }
}
