<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Stream\Stream;
use App\Models\Stream\StreamLog;
use App\Repositories\Common\DateFilter;
use Illuminate\Database\Query\JoinClause;

/**
 * Class StreamRepository
 * @package App\Repositories
 */
class StreamRepository
{
    use DateFilter;

    /**
     * @var int
     */
    const PER_PAGE = 100;

    /**
     * @param array $filters
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByFilters(array $filters, array $columns = ['*'])
    {
        $createdFilter = $this->getCreatedFilter($filters);

        return Stream::join('stream_logs', function (JoinClause $join) use ($filters, $createdFilter) {
            $join->on('streams.id', 'stream_logs.stream_id')
                ->whereIn('stream_logs.game_id', $filters['games'])
                ->whereBetween('created_at', $createdFilter);
        })
            ->join('games', 'games.id', 'streams.game_id')
            ->paginate(self::PER_PAGE, $columns);
    }

    /**
     * @param array $filters
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getViewersByFilters(array $filters, array $columns = ['*'])
    {
        $createdFilter = $this->getCreatedFilter($filters);

        $logs = StreamLog::select(['stream_id', \DB::raw('MAX(viewer_count) as viewer_count')])
            ->whereBetween('created_at', $createdFilter)
            ->whereIn('game_id', $filters['games'])
            ->groupBy('stream_id');

        return Stream::joinSub($logs, 'logs', function (JoinClause $join) {
            $join->on('streams.id', 'logs.stream_id');
        })
            ->join('games', 'games.id', 'streams.game_id')
            ->groupBy('game_id')
            ->select(\DB::raw('SUM(viewer_count) as viewer_count'))
            ->addSelect($columns)
            ->paginate(self::PER_PAGE);
    }
}
