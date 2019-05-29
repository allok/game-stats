<?php

namespace App\Console\Commands;

use App\Jobs\GetGameStreams;
use App\Models\Platform\PlatformGame;
use App\Repositories\PlatformGameRepository;
use Illuminate\Console\Command;

class GetStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:streams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app(PlatformGameRepository::class)->all()->each(function (PlatformGame $game) {
            dispatch(new GetGameStreams($game->game_id, $game->platform_id, $game->external_id));
        });

        return true;
    }
}
