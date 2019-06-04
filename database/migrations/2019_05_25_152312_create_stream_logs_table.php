<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('game_id');
            $table->unsignedBigInteger('stream_id');
            $table->unsignedInteger('viewer_count');
            $table->timestamp('created_at')->default(null);

            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('stream_id')->references('id')->on('streams');

            $table->index(['game_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream_logs');
    }
}
