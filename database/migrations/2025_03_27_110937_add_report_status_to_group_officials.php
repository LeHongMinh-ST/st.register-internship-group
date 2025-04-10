<?php

use App\Enums\ReportStatusEnum;
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
            if (!Schema::hasColumn('group_officials', 'report_status')) {
                //$table->enum('report_status', ['pending', 'approved', 'rejected'])->default('pending')->after('report_file');
                $table->enum('report_status', array_map(fn ($status) => $status->value, ReportStatusEnum::cases()))
                ->default(ReportStatusEnum::PENDING->value)->after('campaign_id'); 
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_officials', function (Blueprint $table) {
            $table->dropColumn('report_status');
        });
    }
};
