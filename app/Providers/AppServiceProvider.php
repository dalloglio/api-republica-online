<?php

namespace App\Providers;

use App\Domains\Ad\Ad;
use App\Domains\Ad\Observers\AddressObserver;
use App\Domains\Ad\Observers\ContactObserver;
use App\Domains\Ad\Observers\DetailObserver;
use App\Domains\Ad\Observers\PhotoObserver as AdPhotoObserver;
use App\Domains\Filter\Filter;
use App\Domains\Photo\Photo;
use App\Domains\User\User;
use App\Observers\FilterObserver;
use App\Observers\PhotoObserver;
use App\Observers\UserObserver;
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

        Ad::observe(AddressObserver::class);
        Ad::observe(ContactObserver::class);
        Ad::observe(DetailObserver::class);
        Ad::observe(AdPhotoObserver::class);

        Filter::observe(FilterObserver::class);
        Photo::observe(PhotoObserver::class);
        User::observe(UserObserver::class);
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
