<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discussion_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('reply_to')->nullable()->index();
            $table->unsignedBigInteger('attachment_id')->nullable()->index();
            $table->timestamps();
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
