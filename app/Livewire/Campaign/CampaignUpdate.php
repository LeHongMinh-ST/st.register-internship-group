<?php

namespace App\Livewire\Campaign;

use App\Common\Constants;
use App\Models\Campaign;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CampaignUpdate extends Component
{
    public int|string $campaignId;

    #[Validate(as: 'tên đợt chiến dịch')]
    public string $name = '';

    #[Validate('required', as: 'ngày bắt đầu')]
    public string $start = '';

    #[Validate('required', as: 'ngày kết thúc')]
    public string $end = '';

    #[Validate( as: 'số lượng thành viên trong nhóm')]
    public int $max_student_group = 0;

    public string  $official_end = '';

    public bool $isLoading = false;

    protected $listeners = [
        'update-start-date' => 'updateStartDate',
        'update-end-date' => 'updateEndDate',
        'update-official-end-date' => 'updateOfficialEndDate',
    ];

    public function render()
    {
        return view('livewire.campaign.campaign-update');
    }

    public function mount($id)
    {
        $campaign = Campaign::query()->find($id);
        $this->campaignId = $id;
        $this->name = $campaign->name;
        $this->start = Carbon::make($campaign->start)->format(Constants::FORMAT_DATE);
        $this->end = Carbon::make($campaign->end)->format(Constants::FORMAT_DATE);
        $this->official_end = Carbon::make($campaign->official_end ?? now())->format(Constants::FORMAT_DATE);
        $this->max_student_group = $campaign->max_student_group;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255'
            ],
            'max_student_group' => [
                'required',
                'min:1',
                'numeric'
            ]
        ];
    }

    public function updatedMaxStudentGroup($value)
    {
        $this->max_student_group = (int) $value;
    }

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function updateStartDate($value): void
    {
        if ($value) {
            $this->resetValidation('start');
        }
        $this->start = str_replace('/', '-', $value);
    }

    public function updateEndDate($value): void
    {
        if ($value) {
            $this->resetValidation('end');
        }
        $this->end = str_replace('/', '-', $value);
    }

    public function updateOfficialEndDate($value): void
    {
        if ($value) {
            $this->resetValidation('end');
        }
        $this->official_end = str_replace('/', '-', $value);
    }


    public function submit(): RedirectResponse|Redirector|null
    {
        $this->validate();

        if (!$this->isLoading) {
            $this->isLoading = true;
            $this->start = str_replace('/', '-', $this->start);
            $this->end = str_replace('/', '-', $this->end);
            $this->official_end = str_replace('/', '-', $this->official_end);
            // store
            try {
                Campaign::where('id', $this->campaignId)->update([
                    'name' => $this->name,
                    'start' => Carbon::make($this->start),
                    'end' => Carbon::make($this->end),
                    'official_end' => Carbon::make($this->official_end),
                    'max_student_group' => $this->max_student_group
                ]);
                $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
            } catch (Exception $e) {
                $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
                Log::error('Error create campaign', [
                    'method' => __METHOD__,
                    'message' => $e->getMessage(),
                ]);
            }
            $this->isLoading = false;
        }
        return null;
    }

}
