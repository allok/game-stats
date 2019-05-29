<?php

namespace App\Providers;

use App\Managers\GameManager;
use App\Managers\PlatformGameManager;
use App\Managers\StreamManager;
use App\Repositories\GameRepository;
use App\Repositories\PlatformGameRepository;
use App\Repositories\PlatformRepository;
use App\Services\Platforms\Twitch\Api\TwitchApi;
use Illuminate\Support\ServiceProvider;

class CustomProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(GamesApi::class, TwitchTopGamesApi::class); TODO don't work WHY??????

        $this->app->singleton(TwitchApi::class);

        $this->app->singleton(GameRepository::class);
        $this->app->singleton(PlatformGameRepository::class);
        $this->app->singleton(PlatformRepository::class);

        // TODO here?
        $this->app->singleton(GameManager::class);
        $this->app->singleton(PlatformGameManager::class);
        $this->app->singleton(StreamManager::class);
    }
}
