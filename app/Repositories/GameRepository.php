<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Game;
use App\Models\Stream\Stream;
use App\Models\Stream\StreamLog;
use App\Repositories\Common\DateFilter;
use Illuminate\Database\Query\JoinClause;

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

        $latestPosts = StreamLog::select(['stream_id', \DB::raw('MAX(viewer_count) as viewer_count')])
            ->whereBetween('created_at', $createdFilter)
            ->whereIn('game_id', $filters['games'])
            ->groupBy('stream_id');
        //dd($latestPosts->get());

        $users = Stream::joinSub($latestPosts, 'latest_posts', function (JoinClause $join) {
            $join->on('streams.id', 'latest_posts.stream_id');
        })
            ->groupBy('game_id')
            ->select('game_id', \DB::raw('SUM(viewer_count) as viewer_count'));
        //->get();
        return $users->paginate(self::PER_PAGE);

        /////////


        $latestPosts = StreamLog::select(['stream_id', \DB::raw('MAX(viewer_count) as viewer_count')])
            ->whereBetween('created_at', $createdFilter)
            ->groupBy('stream_id');
        //dd($latestPosts->get());

        $users = Stream::joinSub($latestPosts, 'latest_posts', function (JoinClause $join) {
            $join->on('streams.id', 'latest_posts.stream_id');
        })->whereIn('game_id', $filters['games'])
            ->groupBy('game_id')
            ->select('game_id', \DB::raw('SUM(viewer_count) as viewer_count'));
        //->get();
        return $users->paginate(self::PER_PAGE);

        /////////

        $latestPosts = StreamLog::select(['stream_id', \DB::raw('MAX(viewer_count) as viewer_count')])
            ->whereBetween('created_at', $createdFilter)
            ->groupBy('stream_id');

        $users = Stream::joinSub($latestPosts, 'latest_posts', function (JoinClause $join) {
            $join->on('streams.id', 'latest_posts.stream_id');
        })->groupBy('game_id')
            ->select('game_id', \DB::raw('SUM(viewer_count) as viewer_count'));
        //->get();
        return $users->paginate(self::PER_PAGE);

////////

        return StreamLog::join('streams', function (JoinClause $join) use ($createdFilter) {
            $join->on('stream_id', 'streams.id')
                ->whereBetween('created_at', $createdFilter)
                ->having(\DB::raw('MAX(`viewer_count`) = viewer_count'));
            ///->groupBy('stream_id');
            //->having(\DB::raw('MAX(viewer_count) = viewer_count'));
        })
            ->whereIn('game_id', $filters['games'])
            ->groupBy('game_id', 'stream_id')
            ->addSelect(\DB::raw('SUM(`viewer_count`) as viewer_count'))
            //->addSelect(\DB::raw('viewer_count'))
            ->addSelect($columns)
            ->paginate(self::PER_PAGE); // todo maybe add game name
    }
}
