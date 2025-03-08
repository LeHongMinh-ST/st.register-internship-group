<?php

namespace App\Livewire\Teacher\Topic;

use Livewire\Component;

use App\Models\Topic;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Common\Constants;

class TopicIndex extends Component
{    
    use WithPagination;

    public string $search = '';

    public int $topicId;

    protected $listeners = [
        'deleteTopic' => 'handleDeleteTopic',
    ];

    public function render()
    {
        $teacherId = Auth::guard('teacher')->user()->id;
        $topics = Topic::where('teacher_id', $teacherId)
        ->search($this->search)
        ->paginate(Constants::PER_PAGE_ADMIN);
        return view('livewire.teacher.topic.topic-index', compact('topics'));
    }

    public function openDeleteModal(int $id): void
    {
        $this->topicId = $id;
        $this->dispatch('openDeleteModal');
    }
    
    public function handleDeleteTopic(): void
    {
        Topic::destroy($this->topicId);
        $this->dispatch('alert', type: 'success', message: 'Xóa thành công');
    }

    public $selectedTopic = null;

    public function topicDetail($id): void
    {
        $this->selectedTopic = Topic::find($id);
    }
}
