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
            if (!Schema::hasColumn('group_officials', 'report_file')) {
                $table->string('report_file')->nullable()->after('campaign_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_officials', function (Blueprint $table) {
            $table->dropColumn('report_file');
        });
    }
};
