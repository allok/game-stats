<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Common\DateFilter;

class GameRepository
{
    use DateFilter;

    /**
     * @var int
     */
    const PER_PAGE = 100;

    /**
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(array $columns = ['*'])
    {
        return Game::active()->paginate(self::PER_PAGE, $columns);
    }
}
