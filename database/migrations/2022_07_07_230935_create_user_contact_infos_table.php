<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_contact_infos');
    }
};
