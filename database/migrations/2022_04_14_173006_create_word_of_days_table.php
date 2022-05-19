<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordOfDaysTable extends Migration
{
    public function up()
    {
        Schema::create('word_of_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('game_id');
            $table->string('word', 5);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('word_of_days');
    }
}
