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
        Schema::create('sections', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id')->index();
            $table->nullableMorphs('content');
            $table->timestamps();
            $table->boolean('visible')->default(true);
            $table->integer('sort_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
