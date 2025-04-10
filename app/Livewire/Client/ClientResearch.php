<?php

namespace App\Livewire\Client;

use App\Common\Constants;
use App\Jobs\SendRequestEditMailJob;
use App\Mail\RequestEditMail;
use App\Models\Campaign;
use App\Models\Group;
use App\Models\GroupKey;
use App\Models\PlanDetail;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ClientResearch extends Component
{
    #[Validate(as: 'mã sinh viên')]
    public string $code = '';

    #[Validate(as: 'ngày sinh')]
    public string $dob = '';

    public int|string $campaignId;

    public bool $isLoading = false;

    public $group;

    public $isCaptain;

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
        // $campaign = Campaign::find($this->campaignId);
        $campaign = Campaign::with('planTemplate')->find($this->campaignId);
        $plans = PlanDetail::query()
            ->where('plan_template_id', $campaign->planTemplate->id ?? null)
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.client.client-research', [
            'campaign' => $campaign,
            'plans' => $plans,
            'planName' => $campaign->planTemplate->name ?? 'Chưa có kế hoạch',
        ]);
    }

    public function resetData()
    {
        $this->group = null;
        $this->student = null;
        $this->dob = '';
        $this->code = '';
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

        if (! $this->student) {
            $this->dispatch('alert', type: 'error', message: 'Không tìm thấy nhóm tương ứng');

            return;
        }
        $this->group = Group::query()
            ->where('id', $this->student->group_id)
            ->with(['students', 'students.groupStudent'])
            ->first();

        $this->isCaptain = $this->group->captain->code;
    }

    public function sendMailEdit()
    {
        if (! $this->student->groupStudent->is_captain) {
            return;
        }

        //        if (isset($this->group->groupKey) && $this->group->groupKey->active && $this->group->groupKey->isExpired()) {
        //            $this->dispatch('alert', type: 'success', message: 'Hệ thống đã gửi email, vui lòng mở email và kích vào link để chỉnh sửa thông tin.');
        //            return;
        //        }

        if (! $this->isLoading) {
            $this->isLoading = true;
            try {
                $groupKey = GroupKey::create([
                    'group_id' => $this->group->id,
                    'key' => Str::random(),
                    'group_type' => Group::class,
                ]);

                $groupKey->active = true;
                $groupKey->save();

                $mailTo = env('APP_ENV') == 'local' ? 'hwanghaha123@gmail.com' : $this->student->groupStudent->email;

                SendRequestEditMailJob::dispatch($mailTo, $this->student, $groupKey->key)->onQueue('mail');
                //                Mail::to($mailTo)->send(new RequestEditMail($this->student, $groupKey->key));
                $this->dispatch('alert', type: 'success', message: 'Hệ thống đã gửi email, vui lòng mở email và kích vào link để chỉnh sửa thông tin.');
            } catch (\Exception $exception) {
                Log::error('send mail edit group', [
                    'message' => $exception->getMessage(),
                ]);
                $this->dispatch('alert', type: 'error', message: 'Có lỗi sảy ra vui lòng thử lại sau!');
            }
            $this->isLoading = false;
        }

    }

    public function openPlanModal()
    {
        $this->dispatch('open-plan-modal');
    }
}
