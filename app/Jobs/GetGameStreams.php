<?php

namespace App\Jobs;

use App\Managers\StreamManager;
use App\Services\Platforms\Factory\MapperFactory;
use App\Services\Platforms\Factory\PlatformFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetGameStreams
 * @package App\Jobs
 */
class GetGameStreams implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $gameId;

    /**
     * @var int
     */
    private $platformId;

    /**
     * @var int
     */
    private $externalId;

    /**
     * @var string|null
     */
    private $pagination;

    /**
     * Create a new job instance.
     *
     * @param int $gameId
     * @param int $platformId
     * @param int $externalId
     * @param string|null $pagination
     */
    public function __construct(int $gameId, int $platformId, int $externalId, ?string $pagination = null)
    {
        $this->gameId = $gameId;
        $this->platformId = $platformId;
        $this->externalId = $externalId;
        $this->pagination = $pagination;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $streams = PlatformFactory::factory($this->platformId)->getStreams([$this->externalId], $this->pagination);
        $mapper = MapperFactory::factory($this->platformId);

        app(StreamManager::class)->save($streams['data'], $this->gameId, $mapper); // TODO there is error on insert key

        if ($pagination = data_get($streams, $mapper->pagination)) {
            dispatch(new GetGameStreams($this->gameId, $this->platformId, $this->externalId, $pagination));
        }
    }
}
