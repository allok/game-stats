<?php

namespace App\Services\Platforms\Contracts;

interface PlatformApiInterface
{
    const TWITCH_ID = 1;

    const YOUTUBE_ID = 2;

    /**
     * @param string|null $after
     * @return array
     */
    public function getTopGames(?string $after = null): array;

    /**
     * @param array $gameIds
     * @param string|null $after
     * @return array
     */
    public function getStreams(array $gameIds, ?string $after): array;
}
