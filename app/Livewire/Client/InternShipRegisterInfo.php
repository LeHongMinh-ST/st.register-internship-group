<?php

namespace App\Livewire\Client;

use App\Models\Campaign;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use function Symfony\Component\String\s;

class InternShipRegisterInfo extends Component
{

    public string $code = '';

    public string $dob = '';
    public string $topic = '';
    public string $supervisor = '';

    public bool $preview = false;

    public $studentChecked = [];

    public int $countMember;


    public int|string $campaignId;

    public array $dataStudent = [];

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function rules(): array
    {
        return [

            'dataStudent.*.email' => [
                'required',
                'email'
            ],
            'dataStudent.*.phone' => [
                'required',
                'max:255'
            ],
            'dataStudent.*.phone_family' => [
                'required',
                'max:255'
            ],


        ];
    }
    protected $validationAttributes = [
        'dataStudent.*.email' => 'email',
        'dataStudent.*.phone' => 'số điện thoại',
        'dataStudent.*.phone_family' => 'số điện thoại phụ huynh',
        'dataStudent.*.internship_company' => 'internship_company',
    ];

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

        foreach ([$this->code, ...$this->studentChecked] as $value) {
            $this->dataStudent[$value] = [
                'email' => '',
                'phone' => '',
                'phone_family' => '',
                'internship_company' => ''
            ];
        }
    }

    public function nextStepFinish()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $group = Group::create([
                'topic' => $this->topic,
                'supervisor' => $this->supervisor,
                'campaign_id' => $this->campaignId
            ]);

            foreach ($this->dataStudent as $code =>  $item) {
                $student = Student::query()->where('code', $code)
                    ->where('campaign_id', $this->campaignId)
                    ->first();

                if ($student->group_id) {
                    $this->dispatch('alert', type: "error", message: "Tạo nhóm thực tập thất bại! Sinh viên ". $student . " đã có nhóm thực tập");
                    DB::rollBack();
                    throw new \Exception();
                }

                $student->group_id = $group->id;
                $student->save();

                GroupStudent::create([
                    'email' => $item['email'],
                    'phone' => $item['phone'],
                    'phone_family' => $item['phone_family'],
                    'internship_company' => $item['internship_company'],
                    'student_id' => $student->id,
                    'is_captain' => $this->code == $code
                ]);
            }
            DB::commit();
            $this->dispatch('nextSuccess')->to(InternShipRegister::class);
        }catch (\Exception $exception) {
            Log::error('create group', [
                'message' => $exception->getMessage(),
            ]);
            $this->dispatch('alert', type: "error", message: "Tạo nhóm thực tập thất bại");
            DB::rollBack();
        }
    }

    public function preStep()
    {
        $this->dispatch('preStepTwo')->to(InternShipRegister::class);
    }

    public function nextPreview()
    {
        $this->validate();
        $this->preview = true;
    }

    public function prePreview()
    {
        $this->preview = false;
    }
}
