<?php

namespace App\Repositories\Common;

use Carbon\Carbon;

trait DateFilter
{
    /**
     * Default time range in minutes
     *
     * @var int
     */
    protected static $timeRange = 5;

    /**
     * @param array $filters
     * @return array
     */
    protected function getCreatedFilter(array $filters): array
    {
        $createdFrom = isset($filters['created']['from'])
            ? Carbon::parse($filters['created']['from'])
            : Carbon::now()->subMinutes(self::$timeRange);

        $createdTo = isset($filters['created']['to'])
            ? Carbon::parse($filters['created']['to'])
            : Carbon::now();

        return [$createdFrom, $createdTo];
    }
}
