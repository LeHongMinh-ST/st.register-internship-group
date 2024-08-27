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
        Schema::create('student_group_officials', function (Blueprint $table) {
            $table->id();
            $table->string('internship_company', 255)->nullable();
            $table->string('supervisor_company', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('phone_family', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->unsignedBigInteger('student_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_group_officials');
    }
};
