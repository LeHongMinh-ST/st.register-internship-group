<?php

namespace App\Livewire\Teacher\Topic;

use Livewire\Component;
use App\Models\Campaign;
use App\Enums\CampaignStatusEnum;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;

class TopicEdit extends Component
{
    #[Validate(as: 'tên đề tài')]
    public string $title = '';

    #[Validate(as: 'đợt đăng ký')]
    public $campaign_id;

    #[Validate(as: 'mô tả')]
    public $description;

    public $id;

    public function mount(): void
    {
        $this->id = request()->id;
        $topic = Topic::findOrFail($this->id);
        $this->title = $topic->title;
        $this->description = $topic->description;
        $this->campaign_id = $topic->campaign_id;
    }

    public function render()
    {
        $campaigns = Campaign::where('status', CampaignStatusEnum::Active)->get();
        return view('livewire.teacher.topic.topic-edit', [
            'campaigns' => $campaigns
        ]);
    }

    public function update()
    {
        $this->validate();

        Topic::where('id', $this->id)->update([
            'title' => $this->title,
            'description' => $this->description,
            'campaign_id' => $this->campaign_id,
        ]);
        
        session()->flash('success', 'Cập nhật đề tài thành công!');
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
