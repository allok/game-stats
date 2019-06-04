<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Stream\Stream;
use App\Services\Platforms\Contracts\PlatformMapperInterface as PlatformMapper;

class StreamManager
{
    /**
     * @param array $streams
     * @param int $gameId
     * @param PlatformMapper $mapper
     * @return void
     */
    public function save(array $streams, int $gameId, PlatformMapper $mapper): void
    {
        if (!$streams) {
            return;
        }

        $now = now();

        $streamLogs = [];

        foreach ($streams as $stream) {
            $streamId = Stream::firstOrCreate([
                'platform_id' => $mapper->platformId,
                'external_id' => $stream[$mapper->id],
            ], [
                'user_id' => $stream[$mapper->user_id],
                'game_id' => $gameId,
            ])->id;

            $streamLogs[] = [
                'stream_id' => $streamId,
                'viewer_count' => $stream[$mapper->viewer_count],
                'created_at' => $now,
                'game_id' => $gameId,
            ];
        }

        \DB::table('stream_logs')->insert($streamLogs);
    }
}
