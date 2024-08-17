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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor', 255);
            $table->text('topic');
            $table->timestamps();
        });

        Schema::create('group_students', function (Blueprint $table) {
            $table->id();
            $table->string('internship_company', 255);
            $table->string('phone', 255);
            $table->string('email', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
