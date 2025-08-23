<?php

namespace App\Livewire\Teacher\Topic;

use Livewire\Component;
use App\Models\Campaign;
use App\Enums\CampaignStatusEnum;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;

class TopicCreate extends Component
{
    #[Validate(as: 'tên đề tài')]
    public string $title = '';

    #[Validate(as: 'đợt đăng ký')]
    public $campaign_id;

    #[Validate(as: 'mô tả')]
    public $description;

    public function render()
    {
        $campaigns = Campaign::where('status', CampaignStatusEnum::Active)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.teacher.topic.topic-create', [
            'campaigns' => $campaigns
        ]);
    }

    public function mount(): void
    {
        $this->title = session('copied_title', '');
        $this->description = session('copied_description', '');
    }


    public function store()
    {
        $this->validate();

        Topic::create([
            'title' => $this->title,
            'description' => $this->description,
            'campaign_id' => $this->campaign_id,
            'teacher_id' => Auth::guard('teacher')->user()->id,
        ]);

        session()->flash('success', 'Tạo chủ đề thành công!');
        return redirect()->route('teacher.topics');
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'campaign_id' => 'required',
            'description' => 'max:600',
        ];
    }
}
