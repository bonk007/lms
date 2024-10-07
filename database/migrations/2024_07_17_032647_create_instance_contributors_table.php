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
        Schema::create('instance_contributors', static function (Blueprint $table) {
            $table->unsignedBigInteger('instance_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->integer('status')->default(1); // 0: inactive, 1: active
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instance_contributors');
    }
};
