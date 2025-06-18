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
            ->orderBy('created_at', 'desc')
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

    // public function copy($id)
    // {
    //     $original = Topic::find($id);

    //     if ($original) {
    //         $newTopic = $original->replicate(); 
    //         $newTopic->title = $original->title . ' - bản sao';
    //         $newTopic->description = $original->description;
    //         $newTopic->save();
    //     }

    //     $this->dispatch('alert', type: 'success', message: 'Sao chép đề tài thành công!');
    // }
    public function copy($id)
    {
        $original = Topic::find($id);

        if (!$original) {
            $this->dispatch('alert', type: 'error', message: 'Không tìm thấy đề tài.');
            return;
        }

        // Gửi dữ liệu sang component tạo mới
        session()->flash('copied_title', $original->title);
        session()->flash('copied_description', $original->description);

        // Redirect sang route tạo đề tài
        return redirect()->route('teacher.topics.create');
    }
}
