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
        if (Schema::hasColumns('course_sessions', ['aui_schema', 'cl_status'])) {
            return;
        }

        Schema::table('course_sessions', static function (Blueprint $table) {
            $table->string('aui_schema')->nullable();
            $table->string('cl_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumns('course_sessions', ['aui_schema', 'cl_status'])) {
            return;
        }

        Schema::table('course_sessions', static function (Blueprint $table) {
            $table->dropColumn(['aui_schema', 'cl_status']);
        });
    }
};
