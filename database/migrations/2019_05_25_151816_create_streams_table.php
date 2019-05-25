<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('platform_id');
            $table->unsignedBigInteger('external_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('game_id');
            $table->timestamp('started_at');

            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams');
    }
}
