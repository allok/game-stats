<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Stream\Stream;
use App\Repositories\Common\DateFilter;
use Illuminate\Database\Eloquent\Builder;

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

        return Stream::whereHas('logs', function (Builder $query) use ($createdFilter) {
            $query->whereBetween('created_at', $createdFilter);
        })
            ->whereIn('game_id', $filters['games'])
            ->paginate(self::PER_PAGE, $columns); // todo maybe add game name
    }
}
