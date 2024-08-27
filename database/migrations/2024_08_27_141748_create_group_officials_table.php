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
        Schema::create('group_officials', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('supervisor', 255)->nullable();
            $table->string('department', 255)->nullable();
            $table->string('supervisor_official', 255)->nullable();
            $table->text('topic')->nullable();
            $table->unsignedBigInteger('campaign_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_officials');
    }
};
