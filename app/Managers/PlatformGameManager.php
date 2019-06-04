<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Platform\PlatformGame;
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
        foreach ($games as $game) {
            $baseGame = app(GameManager::class)->firstOrCreate(['name' => $game{$mapper->gameName}]);

            PlatformGame::firstOrCreate([
                'game_id' => $baseGame->id,
                'platform_id' => $mapper->platformId,
                'external_id' => $game{$mapper->id},
            ]);
        }
    }
}
