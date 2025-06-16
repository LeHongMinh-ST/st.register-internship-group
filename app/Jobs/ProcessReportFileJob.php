<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\GroupOfficial;
use App\Enums\ReportStatusEnum;


class ProcessReportFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $groupOfficialId;
    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($groupOfficialId, $filePath)
    {
        $this->groupOfficialId = $groupOfficialId;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $group = GroupOfficial::find($this->groupOfficialId);
        if ($group) {
            $group->update([
                'report_file' => $this->filePath,
                'report_status' => ReportStatusEnum::PENDING->value,
            ]);
        }
    }
}
