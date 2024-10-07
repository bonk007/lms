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
        Schema::create('questions', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->mediumText('html_content')->nullable();
            $table->string('content_url')->nullable();
            $table->string('content_mime')->default('text/html');
            $table->boolean('streaming')->default(false);
            $table->string('type')->default('essay'); // essay, short answer, single choice, multiple choices, boolean
            $table->json('options')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
