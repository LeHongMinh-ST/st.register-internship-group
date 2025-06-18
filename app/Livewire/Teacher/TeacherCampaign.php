<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Campaign;
use App\Common\Constants;
use Illuminate\Support\Facades\Auth;

class TeacherCampaign extends Component
{
    public string $search = '';

    public function render()
    {
        $teacher = Auth::guard('teacher')->user();

        $campaigns = Campaign::query()
        ->search($this->search)
        ->withCount(['officialGroups' => function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        }])
        ->orderBy('created_at', 'desc')
        ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.teacher.teacher-campaign') ->with([
            'campaigns' => $campaigns,
        ]);
    }
}
