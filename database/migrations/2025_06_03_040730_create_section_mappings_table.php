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
        Schema::create('section_mappings', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->index();
            $table->unsignedBigInteger('section_id')->index();
            $table->timestamps();
            $table->string('marked_as');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_mappings');
    }
};
