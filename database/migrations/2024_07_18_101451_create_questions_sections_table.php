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
        Schema::create('questions_sections', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id')->index();
            $table->unsignedBigInteger('quiz_section_id')->index();
            $table->integer('sort_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_sections');
    }
};
