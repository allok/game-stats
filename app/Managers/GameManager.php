<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Game;
use App\Repositories\Common\DateFilter;

class GameManager
{
    use DateFilter;

    /**
     * @var int
     */
    const PER_PAGE = 100;

    /**
     * @param array $attributes
     * @return Game
     */
    public function firstOrCreate(array $attributes): Game
    {
        return Game::firstOrCreate($attributes);
    }
}
