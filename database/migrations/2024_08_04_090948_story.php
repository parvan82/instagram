<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('story', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('content');
            $table->dateTime('expiration_time');
            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('story');
    }
};
