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
        if (Schema::hasColumn('agendas', 'course_id')) {
            return;
        }
        Schema::table('agendas', static function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('agendas', 'course_id')) {
            return;
        }

        Schema::table('agendas', static function (Blueprint $table) {
            $table->dropIndex(['course_id']);
            $table->dropColumn(['course_id']);
        });
    }
};
