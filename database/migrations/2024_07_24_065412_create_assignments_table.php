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
        Schema::create('assignments', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->index();
            $table->timestamps();
            $table->timestamp('started_at');
            $table->softDeletes();
            $table->string('title');
            $table->text('description');
            $table->integer('duration')->nullable();
            $table->string('duration_unit')->nullable(); // null: no time limited, minutes, hours, days
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
