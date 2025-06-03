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
        if (Schema::hasColumn('gazer_records', 'section_id')) {
            return;
        }

        Schema::table('gazer_records', static function (Blueprint $table) {
            $table->unsignedBigInteger('section_id')
                ->nullable()
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('gazer_records', 'section_id')) {
            return;
        }

        Schema::table('gazer_records', static function (Blueprint $table) {
            $table->dropIndex(['section_id']);
            $table->dropColumn(['section_id']);
        });
    }
};
