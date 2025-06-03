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
        if (Schema::hasColumn('enrollments', 'aui_enabled')) {
            return;
        }

        Schema::table('enrollments', static function (Blueprint $table) {
            $table->boolean('aui_enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('enrollments', 'aui_enabled')) {
            return;
        }

        Schema::table('enrollments', static function (Blueprint $table) {
            $table->dropColumn('aui_enabled');
        });
    }
};
