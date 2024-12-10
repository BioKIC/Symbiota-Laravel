<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        $this->app->singleton(\Faker\Generator::class, function () {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \App\Faker\TaxonomyProvider($faker));

            return $faker;
        });

        $this->app->bind(\Faker\Generator::class . ':' . config('app.faker_locale'), \Faker\Generator::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        //
    }
}
