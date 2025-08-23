<?php

namespace App\Livewire\Topic;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Topic;
use App\Common\Constants;
use App\Models\Teacher;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTopicList;

class TopicShow extends Component
{
    use WithPagination;

    public string $search = '';

    public int|string $campaignId = '';

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function render()
    {
        $topics = Topic::query()
            ->with('teacher')
            ->where('campaign_id', $this->campaignId)
            ->where(function ($q) {
                $q->where('topics.title', 'like', "%{$this->search}%")
                    ->orWhereHas('teacher', function ($teacherQuery) {
                        $teacherQuery->where('teachers.name', 'like', "%{$this->search}%");
                    });
            })
            ->join('teachers', 'topics.teacher_id', '=', 'teachers.id')
            ->orderBy('teachers.department', 'asc')
            ->orderByRaw("SUBSTRING_INDEX(teachers.name, ' ', -1) ASC")
            ->orderBy('teachers.name', 'asc')
            ->select('topics.*') // tránh lỗi xung đột cột id
            ->paginate(Constants::PER_PAGE_ADMIN);
        return view('livewire.topic.topic-show', compact('topics'));
    }

    public function export()
    {
        return Excel::download(new ExportTopicList($this->campaignId), 'danh-sach-huong-de-tai.xlsx');
    }
}
