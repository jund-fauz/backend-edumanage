<?php

namespace App\Providers;

use App\Faker\LessonProvider;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, function ($app) {
            $faker = Factory::create($app['config']->get('app.faker_locale', 'id_ID'));
            $faker->addProvider(new LessonProvider($faker));
            return $faker;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
