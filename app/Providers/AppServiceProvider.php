<?php

namespace App\Providers;

use App\Domains\Ad\Ad;
use App\Domains\Banner\Banner;
use App\Domains\Contact\Contact;
use App\Domains\Form\Form;
use App\Domains\Partner\Partner;
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
            'banners' => Banner::class,
            'contacts' => Contact::class,
            'forms' => Form::class,
            'partners' => Partner::class,
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
