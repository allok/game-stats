<?php

namespace App\Console\Commands;

use App\Jobs\GetPlatformTopGames;
use App\Models\Platform\Platform;
use App\Repositories\PlatformRepository;
use Illuminate\Console\Command;

class GetTopGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:games:top';

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
        app(PlatformRepository::class)->all(['id'])->each(function (Platform $platform) {
            dispatch(new GetPlatformTopGames($platform->id));
        });

        return true;
    }
}
