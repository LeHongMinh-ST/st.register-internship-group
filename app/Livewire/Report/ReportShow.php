<?php

namespace App\Livewire\Report;

use Livewire\Component;
use App\Models\GroupOfficial;
use App\Common\Constants;
use Illuminate\Support\Str;

class ReportShow extends Component
{
    public int|string $campaignId = '';

    public string $search = '';

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function render()
    {
        $groups = GroupOfficial::where('campaign_id', $this->campaignId)
            ->search($this->search)
            ->paginate(Constants::PER_PAGE_ADMIN);
        return view('livewire.report.report-show', [
            'groups' => $groups
        ]);
    }

    public function downloadReport($groupId)
    {
        $group = GroupOfficial::findOrFail($groupId);

        $filePath = storage_path('app/public/' . $group->report_file);

        $extension = pathinfo($group->report_file, PATHINFO_EXTENSION);

        $campaignName = $group->campaign->name;
        $campaignName = strtoupper(Str::slug($campaignName, '_'));

        $fileName = "BAO_CAO_{$campaignName}_NHOM_{$group->code}.{$extension}";

        return response()->download($filePath, $fileName);
    }

    public function approveReport($groupId)
    {
        $group = GroupOfficial::findOrFail($groupId);
        $group->update(['report_status' => \App\Enums\ReportStatusEnum::APPROVED->value]);
    }

    public function rejectReport($groupId)
    {
        $group = GroupOfficial::findOrFail($groupId);
        $group->update(['report_status' => \App\Enums\ReportStatusEnum::REJECTED->value]);
    }
}
