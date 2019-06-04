<?php

use App\Models\Platform\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = (new Platform())->getTable();

        \DB::table($table)->insert([
            'name' => 'Twitch',
        ]);
    }
}
