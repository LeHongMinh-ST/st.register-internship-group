<?php

namespace App\Livewire\Client;

use App\Models\Campaign;
use App\Models\Course;
use App\Models\Student;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InternShipRegisterMember extends Component
{
    public string $code = '';

    public string $dob = '';

    public $studentChecked = [];

    public int $countMember;

    public string $search = '';

    public int|string $campaignId;

    public function clickCheckBox($code)
    {
        if (in_array($code, $this->studentChecked)) {
            $this->studentChecked = array_diff($this->studentChecked, [$code]);
        } else {

            $student = Student::query()->where('code', $code)
                ->whereNotNull('group_id')
                ->where('campaign_id', $this->campaignId)
                ->first();

            if ($student) {
                $this->dispatch('alert', type: 'error', message: 'Sinh viên ' . $student->name . '-' . $student->code . 'đã đăng ký nhóm TTCN/KLTN');
                $this->dispatch('$refresh');
                return;
            }
            $this->studentChecked[] = $code;
        }
    }

    public function render()
    {
        $student = Student::query()
            ->where('code', $this->code)
            ->with(['course', 'campaign'])
            ->where('campaign_id', $this->campaignId)
            ->first();

        $students = Student::query()
            ->search($this->search)
            ->whereNotIn('id', [$student->id])
            ->where('course_id', $student->course_id)
            ->where('group_id', null)
            ->where('campaign_id', $this->campaignId)
            ->get();

        $campaign = Campaign::find($this->campaignId);

        return view('livewire.client.intern-ship-register-member', [
            'student' => $student,
            'students' => $students,
            'campaign' => $campaign,
        ]);
    }

    public function mount($code, $dob, $campaignId, $studentChecked)
    {
        $this->code = $code;
        $this->dob = $dob;
        $this->studentChecked = $studentChecked;
        $this->campaignId = $campaignId;
        $campaign = Campaign::query()->find($campaignId);
        $this->countMember = $campaign->max_student_group;

    }

    public function nextStep()
    {
        $this->dispatch('nextStepThree', [
            'studentChecked' => $this->studentChecked
        ])->to(InternShipRegister::class);
    }

    public function preStep()
    {
        $this->dispatch('preStepOne')->to(InternShipRegister::class);
    }


}
