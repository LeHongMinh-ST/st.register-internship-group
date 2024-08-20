<?php

namespace App\Livewire\Client;

use App\Common\Constants;
use App\Models\Group;
use App\Models\Student;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ClientResearch extends Component
{
    public string $code = '';

    public int|string $campaignId;

    public $group;
    public $student;

    public function render()
    {
        return view('livewire.client.client-research');
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function filterGroup()
    {
        $this->student = Student::query()
            ->where('code', $this->code)
            ->where('campaign_id', $this->campaignId)
            ->whereNotNull('group_id')
            ->first();

        if (!$this->student) {
            $this->dispatch('alert', type: 'error', message: 'Không tìm thấy nhóm tương ứng');
            return;
        }
        $this->group = Group::query()
            ->where('id', $this->student->group_id)
            ->with(['students', 'students.groupStudent'])
            ->first();
    }
}
