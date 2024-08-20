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
    #[Validate(as: 'mã sinh viên')]
    public string $code = '';

    #[Validate(as: 'ngày sinh')]
    public string $dob = '';
    public int|string $campaignId;

    public $group;
    public $student;

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    protected $listeners = [
        'update-dob' => 'updateDob',
    ];

    public function updateDob($value): void
    {
        if ($value) {
            $this->resetValidation('dob');
        }
        $this->dob = str_replace('/', '-', $value);
    }

    public function render()
    {
        return view('livewire.client.client-research');
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function rules(): array
    {
        return [
            'code' => [
                'required',
            ],

            'dob' => [
                'required',
            ],

        ];
    }

    public function filterGroup()
    {

        $this->validate();
        $this->dob = str_replace('/', '-', $this->dob);

        $this->student = Student::query()
            ->where('code', $this->code)
            ->whereDate('dob', Carbon::make($this->dob))
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
