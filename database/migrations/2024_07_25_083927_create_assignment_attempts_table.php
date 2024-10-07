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
        Schema::create('assignment_attempts', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
            $table->double('scores')->default(0);
            $table->tinyInteger('scoring_status')->default(0); // 0: pending, 1: on going, 2: completed
            $table->text('response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_attempts');
    }
};
