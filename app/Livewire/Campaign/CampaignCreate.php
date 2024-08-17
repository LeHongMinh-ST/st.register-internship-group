<?php

namespace App\Livewire\Campaign;

use App\Common\Constants;
use App\Models\Campaign;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CampaignCreate extends Component
{
    #[Validate(as: 'tên đợt chiến dịch')]
    public string $name = '';

    #[Validate('required', as: 'ngày bắt đầu')]
    public string $start = '';

    #[Validate('required', as: 'ngày kết thúc')]
    public string $end = '';

    #[Validate( as: 'số lượng thành viên trong nhóm')]
    public int $max_student_group = 0;

    public bool $isLoading = false;

    protected $listeners = [
        'update-start-date' => 'updateStartDate',
        'update-end-date' => 'updateEndDate',
    ];


    public function mount(): void
    {
        $this->start = Carbon::now()->format(Constants::FORMAT_DATE);
        $this->end = Carbon::now()->format(Constants::FORMAT_DATE);
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


    public function render()
    {
        return view('livewire.campaign.campaign-create');
    }

    public function submit(): RedirectResponse|Redirector|null
    {
        $this->validate();

        if (!$this->isLoading) {
            $this->isLoading = true;
            $this->start = str_replace('/', '-', $this->start);
            $this->end = str_replace('/', '-', $this->end);
            // store
            try {
                Campaign::create([
                    'name' => $this->name,
                    'start' => Carbon::make($this->start),
                    'end' => Carbon::make($this->end),
                    'max_student_group' => $this->max_student_group
                ]);
                session()->flash('success', 'Tạo mới thành công!');
                $this->isLoading = false;
                return redirect()->route('admin.campaigns.index');
            } catch (Exception $e) {
                $this->dispatch('alert', type: 'error', message: 'Tạo mới thất bại!');
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
