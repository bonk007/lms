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
        Schema::create('assignment_attempt_attachment', static function (Blueprint $table) {
            $table->unsignedBigInteger('assignment_attempt_id')->index();
            $table->unsignedBigInteger('attachment_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_attempt_attachment');
    }
};
