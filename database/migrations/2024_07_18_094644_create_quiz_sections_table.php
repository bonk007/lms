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
        Schema::create('quiz_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id')->index();
            $table->timestamps();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_index')->default(0);
            $table->boolean('random_order_questions')->default(false);
//
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_sections');
    }
};
