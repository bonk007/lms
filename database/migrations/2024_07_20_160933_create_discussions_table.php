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
        Schema::create('discussions', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable()->index();
            $table->unsignedBigInteger('initial_post_id')->index();
            $table->unsignedBigInteger('created_by')->index();
            $table->timestamps();
            $table->timestamp('closed_at')->nullable();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};