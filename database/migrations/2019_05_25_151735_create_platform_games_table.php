<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_games', function (Blueprint $table) {
            $table->unsignedInteger('game_id');
            $table->unsignedInteger('platform_id');
            $table->unsignedInteger('external_id');

            $table->primary(['game_id', 'platform_id', 'external_id']); // todo OPTIMIZE

            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('platform_id')->references('id')->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platform_games');
    }
}
