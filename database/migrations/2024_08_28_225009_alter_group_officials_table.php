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
            if (!Schema::hasColumn('group_officials', 'supervisor_code')) {
                $table->string('supervisor_code',255)->nullable();
            }

            if (!Schema::hasColumn('group_officials', 'supervisor_email')) {
                $table->string('supervisor_email',255)->nullable();
            }

            if (!Schema::hasColumn('group_officials', 'supervisor_phone')) {
                $table->string('supervisor_phone',255)->nullable();

            }
        });

        Schema::table('student_group_officials', function (Blueprint $table) {
            if (!Schema::hasColumn('student_group_officials', 'supervisor_company_email')) {
                $table->string('supervisor_company_email',255)->nullable();

            }

            if (!Schema::hasColumn('student_group_officials', 'supervisor_company_phone')) {
                $table->string('supervisor_company_phone',255)->nullable();

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
