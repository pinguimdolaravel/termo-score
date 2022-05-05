<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('daily_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('game_id');
            $table->string('score');
            $table->string('detail');
            $table->string('word', 5)->nullable();
            $table->string('status', 10)->nullable();
            $table->smallInteger('points')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_scores');
    }
};
