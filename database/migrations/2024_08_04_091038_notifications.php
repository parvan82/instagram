<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('like_id')->references('id')->on('likes')->onDelete('cascade');
            $table->foreignId('comment_id')->references('id')->on('comment')->onDelete('cascade');
            $table->foreignId('follow_id')->references('id')->on('follow')->onDelete('cascade');
            $table->foreignId('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreignId('story_id')->references('id')->on('story')->onDelete('cascade');
            $table->boolean('seen_notifications')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
