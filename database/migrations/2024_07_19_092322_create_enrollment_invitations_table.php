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
        Schema::create('enrollment_invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->timestamps();
            $table->timestamp('valid_through');
            $table->string('email')->nullable();
            $table->string('token')->unique();
            $table->integer('status')->default(0); // 0: pending, 1: approved, 2: rejected
            $table->integer('mail_sending_status')->default(0); // 0: in queue, 1: sent, 2: failed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_invitations');
    }
};
