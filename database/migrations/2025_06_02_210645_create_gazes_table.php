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
        Schema::create('gazes', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('course_id')->index();
            $table->unsignedBigInteger('section_id')->nullable()->index();
            $table->timestamps();
            $table->json('activity');
            $table->json('fixation');
            $table->json('amplitude');
            $table->json('velocity');
            $table->double('gaze_transition_entropy');
            $table->double('relative_gte');
            $table->double('transition_diversity_index');
            $table->double('dynamic_gte');
            $table->double('total_transitions');
            $table->string('cl_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gazes');
    }
};
