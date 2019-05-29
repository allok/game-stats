<?php

namespace App\Jobs;

use App\Managers\PlatformGameManager;
use App\Services\Platforms\Factory\MapperFactory;
use App\Services\Platforms\Factory\PlatformFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetPlatformTopGames implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $platformId;

    /**
     * Create a new job instance.
     *
     * @param int $platformId
     */
    public function __construct(int $platformId)
    {
        $this->platformId = $platformId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $games = PlatformFactory::factory($this->platformId)->getTopGames();
        $mapper = MapperFactory::factory($this->platformId);

        app(PlatformGameManager::class)->save($games['data'], $mapper);
    }
}
