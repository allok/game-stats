<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Game;

class GameRepository
{
    /**
     * @param array $attributes
     * @return Game
     */
    public function firstOrCreate(array $attributes): Game
    {
        return Game::firstOrCreate($attributes); // TODO add cache
    }
}
