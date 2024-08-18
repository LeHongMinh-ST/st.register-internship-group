<?php

namespace App\Livewire\Client;

use App\Models\Campaign;
use App\Models\Student;
use Livewire\Component;
use function Symfony\Component\String\s;

class InternShipRegisterInfo extends Component
{

    public string $code = '';

    public string $dob = '';

    public $studentChecked = [];

    public int $countMember;


    public int|string $campaignId;


    public function render()
    {
        $students = Student::query()->whereIn('code',[$this->code, ...$this->studentChecked])
            ->where('campaign_id', $this->campaignId)->get();

        return view('livewire.client.intern-ship-register-info', [
            'students' => $students
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
}
