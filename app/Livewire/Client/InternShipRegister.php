<?php

namespace App\Livewire\Client;

use App\Enums\StepRegisterEnum;
use App\Models\Student;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InternShipRegister extends Component
{
    public StepRegisterEnum $step = StepRegisterEnum::StepOne;

    #[Validate(as: 'mã sinh viên')]
    public string $code = '';

    #[Validate(as: 'ngày sinh')]
    public string $dob = '';

    public int|string $campaignId;

    public array $studentChecked = [];

    protected $listeners = [
        'nextStepThree' => 'nextStepThree',
        'nextSuccess' => 'nextSuccess',
        'preStepOne' => 'preStepOne',
        'preStepTwo' => 'preStepTwo',
        'update-dob' => 'updateDob',
    ];


    public function nextSuccess()
    {
        $this->step = StepRegisterEnum::StepFour;
    }

    public function preStepOne()
    {
        $this->step = StepRegisterEnum::StepOne;
        $this->studentChecked = [];
    }

    public function preStepTwo()
    {
        $this->step = StepRegisterEnum::StepTwo;
    }

    public function nextStepThree($data)
    {
        $this->studentChecked = $data['studentChecked'];
        $this->step = StepRegisterEnum::StepThree;
    }

    public function updateDob($value): void
    {
        if ($value) {
            $this->resetValidation('dob');
        }
        $this->dob = str_replace('/', '-', $value);
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

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function render()
    {
        return view('livewire.client.intern-ship-register');
        //        return view('livewire.client.intern-ship-register-info');

    }

    public function nextStepTwo()
    {
        $this->validate();
        $this->dob = str_replace('/', '-', $this->dob);

        $student = Student::query()
            ->where('code', $this->code)
            ->whereDate('dob', Carbon::make($this->dob))
            ->where('campaign_id', $this->campaignId)
            ->with('campaign')
            ->first();

        if (! $student) {
            $this->dispatch('alert', type: 'error', message: 'Sinh viên không tồn tại hoặc không nằm trong danh sách đủ điều kiện làm TTCN hoặc KLTN');
            return;
        }

        if ($student->group_id) {
            $this->dispatch('alert', type: 'error', message: 'Bạn đã có nhóm thực tập! Vui lòng tra cứu thông tin nhóm tại mục tra cứu');

            return;
        }

        if ($student->campaign->isExpired()) {
            $this->dispatch('alert', type: 'error', message: 'Đã hết thời hạn đăng ký');
            return;
        }

        $this->step = StepRegisterEnum::StepTwo;
    }
}
