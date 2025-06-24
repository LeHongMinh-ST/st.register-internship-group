<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\GroupOfficial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Common\Constants;
use App\Models\PlanDetail;

class TeacherStudentGroup extends Component
{
    public string $search = '';

    public int|string $campaignId;

    public function mount($campaignId)
    {
        $this->campaignId = is_object($campaignId) ? $campaignId->id : $campaignId;
        $this->search = request()->query('search', '');
    }

    public function render()
    {
        $campaign = Campaign::with('planTemplate')->find($this->campaignId);
        $teacherId = Auth::guard('teacher')->user()->id;
        $groups = GroupOfficial::where('campaign_id', $this->campaignId)
            ->where('teacher_id', $teacherId)
            ->search($this->search)
            ->with('students')
            ->get();
        $plans = PlanDetail::query()
            ->where('plan_template_id', $campaign->planTemplate->id ?? null)
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.teacher.teacher-student-group', [
            'groups' => $groups,
            'plans' => $plans,
            'planName' => $campaign->planTemplate->name ?? 'Chưa có kế hoạch',
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

    public function openPlanModal()
    {
        $this->dispatch('open-plan-modal');
    }
}
