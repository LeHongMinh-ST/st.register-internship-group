<?php

namespace App\Livewire\Client;

use App\Jobs\SendRequestEditMailJob;
use App\Models\Campaign;
use App\Models\Group;
use App\Models\GroupKey;
use App\Models\GroupOfficial;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ClientResearchOfficial extends Component
{
    #[Validate(as: 'mã sinh viên')]
    public string $code = '';

    #[Validate(as: 'ngày sinh')]
    public string $dob = '';
    public int|string $campaignId;

    public bool $isLoading = false;

    public $group;
    public $student;

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    protected $listeners = [
        'update-dob' => 'updateDob',
    ];

    public function resetData()
    {
        $this->group = null;
        $this->student = null;
        $this->dob = '';
        $this->code = '';
    }

    public function updateDob($value): void
    {
        if ($value) {
            $this->resetValidation('dob');
        }
        $this->dob = str_replace('/', '-', $value);
    }

    public function render()
    {
        $campaign = Campaign::find($this->campaignId);

        return view('livewire.client.client-research-official', [
            'campaign' => $campaign,
        ]);
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
            ->whereNotNull('group_official_id')
            ->first();

        if (!$this->student) {
            $this->dispatch('alert', type: 'error', message: 'Không tìm thấy nhóm tương ứng');
            return;
        }
        $this->group = GroupOfficial::query()
            ->where('id', $this->student->group_official_id)
            ->with(['students', 'students.studentGroupOfficial'])
            ->first();
    }

    public function sendMailEdit()
    {
        if (!$this->student->groupStudent->is_captain) {
            return;
        }

        if (!$this->isLoading) {
            $this->isLoading = true;
            try {
                $groupKey = GroupKey::create([
                    'group_id' => $this->group->id,
                    'key' => Str::random(),
                ]);

                $groupKey->active = true;
                $groupKey->save();

                $mailTo = env('APP_ENV') == 'local' ? "hongminhle290@gmail.com" : $this->student->groupStudent->email;

                SendRequestEditMailJob::dispatch($mailTo, $this->student, $groupKey->key)->onQueue('mail');
//                Mail::to($mailTo)->send(new RequestEditMail($this->student, $groupKey->key));
                $this->dispatch('alert', type: "success", message: "Hệ thống đã gửi yêu cầu chỉnh sửa. Vui lòng check email bạn đã đăng ký để có thể nhận mã yêu cầu!");
            }catch (\Exception $exception) {
                Log::error('send mail edit group', [
                    'message' => $exception->getMessage(),
                ]);
                $this->dispatch('alert', type: "error", message: "Có lỗi sảy ra vui lòng thử lại sau!");
            }
            $this->isLoading = false;
        }


    }
}
