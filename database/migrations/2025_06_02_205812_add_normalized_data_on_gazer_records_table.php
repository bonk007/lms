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
        if (Schema::hasColumn('gazer_records', 'normalized_data')) {
            return;
        }

        Schema::table('gazer_records', static function (Blueprint $table) {
            $table->json('normalized_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('gazer_records', 'normalized_data')) {
            return;
        }

        Schema::table('gazer_records', static function (Blueprint $table) {
            $table->dropColumn('normalized_data');
        });
    }
};
