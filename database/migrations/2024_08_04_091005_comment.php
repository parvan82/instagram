<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up(): void
{
Schema::create('comment', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
$table->foreignId('post_id')->references('id')->on('posts')->onDelete('cascade');
$table->text('content')->nullable();
$table->timestamps();
});
}


public function down(): void
{
Schema::dropIfExists('comment');
}
};

