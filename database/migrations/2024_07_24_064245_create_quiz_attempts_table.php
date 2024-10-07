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
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('quiz_snapshot_id')->index();
            $table->timestamps();
            $table->timestamp('ended_at')->nullable();
            $table->double('scores')->default(0);
            $table->integer('scoring_status')->default(0); // 0: pending, 1: on going, 2: completed
            $table->boolean('passed')->default(false);
            $table->json('progress')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
