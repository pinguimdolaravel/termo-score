<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('daily_scores', function (Blueprint $table) {
            $table->id();

            $table->string('game_id');
            $table->string('score');
            $table->string('detail');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_scores');
    }
};
