<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Topic;
use App\Models\Campaign;
use Illuminate\Http\Request;

class TeacherModal extends Component
{

    public $campaignId;

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function render()
    {
        $teachers = Teacher::query()
        ->where('status', \App\Enums\TeacherStatusEnum::Accept->value) 
        ->with(['topics' => function ($query) {
            $query->where('campaign_id', $this->campaignId);
        }])
        ->orderBy('name')
        ->get();
        
        return view('livewire.client.teacher-modal', [
            'teachers' => $teachers,
        ]);
    }
}
