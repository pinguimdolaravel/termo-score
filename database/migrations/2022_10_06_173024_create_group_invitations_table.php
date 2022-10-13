<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('group_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_invitations');
    }
};
