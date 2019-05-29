<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Platform\PlatformGame;
use App\Repositories\GameRepository;
use App\Services\Platforms\Contracts\PlatformMapperInterface as PlatformMapper;

class PlatformGameManager
{
    /**
     * @param array $games
     * @param PlatformMapper $mapper
     * @return void
     */
    public function save(array $games, PlatformMapper $mapper): void
    {
        foreach ($games as $game) { // TODO may be return ready array
            $baseGame = app(GameRepository::class)->firstOrCreate(['name' => $game{$mapper->gameName}]);

            PlatformGame::firstOrCreate([
                'game_id' => $baseGame->id,
                'platform_id' => $mapper->platformId,
                'external_id' => $game{$mapper->id},
            ]);
        }
    }
}
