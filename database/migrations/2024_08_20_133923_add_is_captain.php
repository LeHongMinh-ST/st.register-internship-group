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
        Schema::table('group_students', function (Blueprint $table) {
            if (!Schema::hasColumn('group_students', 'is_captain')) {
                $table->boolean('is_captain')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_students', function (Blueprint $table) {
            //
        });
    }
};
