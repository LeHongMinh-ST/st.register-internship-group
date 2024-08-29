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
        Schema::table('group_officials', function (Blueprint $table) {
            if (!Schema::hasColumn('group_officials', 'teacher_id')) {
                $table->unsignedBigInteger('teacher_id',)->nullable();
            }

            if (Schema::hasColumn('group_officials', 'supervisor_official')) {
                $table->dropColumn('supervisor_official');
            }

            if (Schema::hasColumn('group_officials', 'supervisor_code')) {
                $table->dropColumn('supervisor_code');
            }

            if (Schema::hasColumn('group_officials', 'supervisor_email')) {
                $table->dropColumn('supervisor_email');
            }

            if (Schema::hasColumn('group_officials', 'supervisor_phone')) {
                $table->dropColumn('supervisor_phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_officials', function (Blueprint $table) {
            //
        });
    }
};
