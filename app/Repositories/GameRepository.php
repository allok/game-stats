<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Game;
use App\Models\Stream\Stream;
use App\Models\Stream\StreamLog;
use App\Repositories\Common\DateFilter;
use Illuminate\Database\Eloquent\Builder;

class GameRepository
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
        return Game::firstOrCreate($attributes); // TODO add cache
    }

    /**
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(array $columns = ['*'])
    {
        return Game::active()->paginate(self::PER_PAGE, $columns);
    }

    /**
     * @param array $filters
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getViewersByFilters(array $filters, array $columns = ['*'])
    {
        $createdFilter = $this->getCreatedFilter($filters);

        return StreamLog::join('streams', 'stream_id', 'streams.id')
            ->whereBetween('created_at', $createdFilter)
            ->whereIn('game_id', $filters['games'])
            ->groupBy('game_id')
            ->addSelect(\DB::raw('SUM(`viewer_count`) as viewer_count'))
            ->addSelect($columns)
            ->paginate(self::PER_PAGE); // todo maybe add game name
    }
}
