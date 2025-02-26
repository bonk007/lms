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
        Schema::create('slide_items', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slide_id')->index();
            $table->timestamps();
            $table->string('img');
            $table->text('caption')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_items');
    }
};
