<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\GroupOfficial;
use Illuminate\Support\Facades\Auth;


class TeacherStudentGroup extends Component
{
    public int|string $campaignId;

    public function mount($campaignId)
    {
        $this->campaignId = is_object($campaignId) ? $campaignId->id : $campaignId;
    }

    public function render()
    {
        $teacherId = Auth::guard('teacher')->user()->id;
        $groups = GroupOfficial::where('campaign_id', $this->campaignId)
            ->where('teacher_id', $teacherId)
            ->with('students')
            ->get();

        return view('livewire.teacher.teacher-student-group', [
            'groups' => $groups
        ]);
    }
}
