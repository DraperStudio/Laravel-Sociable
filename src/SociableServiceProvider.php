<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Sociable.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Sociable;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;

class SociableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->register(SocialiteServiceProvider::class);

        $this->app['events']->listen(
            Events\UserHasSocialized::class,
            Listeners\UserHasSocializedListener::class
        );
    }
}
