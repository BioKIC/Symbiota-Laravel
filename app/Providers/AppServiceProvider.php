<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/custom');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/core');

        $this->callAfterResolving('blade.compiler', static function (BladeCompiler $compiler) {
            $compiler->extend(static function ($value) {
                return \preg_replace('/\s*@trim\s*/m', '', $value);
            });
        });

        /**
         * Add Query logs For Local Enviroments.
         */
        if (config('app.env') === 'local') {
            DB::listen(function ($query) {
                File::append(
                    storage_path('/logs/query.log'),
                    '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL
                );
            });
        }

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('orcid', \App\Socialite\Orcid\Provider::class);
        });
    }
}
