<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Game;
use App\Models\Platform\PlatformGame;
use Illuminate\Database\Eloquent\Collection;

class PlatformGameRepository
{
    /**
     * @param array $columns
     * @return Collection|PlatformGame[]
     */
    public function all(array $columns = ['*']): Collection
    {
        return PlatformGame::whereHas('game', function ($query) {
            /** @var Game $query */
            $query->active();
        })->get($columns);
    }
}
