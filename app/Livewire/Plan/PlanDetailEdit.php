<?php

namespace App\Livewire\Plan;

use App\Common\Constants;
use App\Models\Plan;
use App\Models\PlanDetail;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlanDetailEdit extends Component
{
    public int|string $planDetailId;
    public int|string $planTemplateId;

    #[Validate(as: 'ngày bắt đầu')]
    public string $start= '';

    #[Validate(as: 'ngày kết thúc')]
    public string $end = '';

    #[Validate(as: 'nội dung')]
    public string $content = '';

    public bool $isLoading = false;

    public function render()
    {
        $planTemplate = Plan::query()->find($this->planTemplateId);
        return view('livewire.plan.plan-detail-edit')->with([
            'planTemplateId' => $this->planTemplateId,
            'planTemplateName' => $planTemplate->name,
        ]);
    }

    public function mount($id, $planTemplateId)
    {
        $this->planDetailId = $id;
        $this->planTemplateId = $planTemplateId;
        $planDetail = PlanDetail::query()->find($id);
        $this->start = Carbon::make($planDetail->start_date)->format(Constants::FORMAT_DATE);
        $this->end = Carbon::make($planDetail->end_date)->format(Constants::FORMAT_DATE);
        $this->content = $planDetail->content;
    }

    public function rules()
    {
        return [
            'content' => 'required',
        ];
    }

    public function submit(): RedirectResponse|Redirector|null
    {
        $this->validate();

        if (!$this->isLoading) {
            $this->isLoading = true;
            $this->start = str_replace('/', '-', $this->start);
            $this->end = str_replace('/', '-', $this->end);
            try {
                $planDetail = PlanDetail::query()->find($this->planDetailId);
                $planDetail->update([
                    'start_date' => Carbon::make($this->start),
                    'end_date' => Carbon::make($this->end),
                    'content' => $this->content,
                ]);
                $this->isLoading = false;
                $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
            } catch (\Exception $e) {
                $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
                Log::error('Error create plan detail', [
                    'method' => __METHOD__,
                    'message' => $e->getMessage(),
                ]);
            }
            $this->isLoading = false;
        }

        return null;
    }

}
