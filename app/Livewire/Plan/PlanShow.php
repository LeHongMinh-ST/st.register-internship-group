<?php

namespace App\Livewire\Plan;

use App\Common\Constants;
use App\Models\Plan;
use App\Models\PlanDetail;
use Livewire\Component;

class PlanShow extends Component
{
    public int|string $planId;
    public int|string $planDetailId;

    protected $listeners = [
        'deletePlanDetail' => 'delete',
    ];

    public function render()
    {
        $planDetails = PlanDetail::with('planTemplate')
            ->where('plan_template_id', $this->planId)
            ->paginate(Constants::PER_PAGE_ADMIN);;
        $plan = Plan::find($this->planId);
        return view('livewire.plan.plan-show')->with([
            'plan' => $plan,
            'planDetails' => $planDetails
        ]);
    }

    public function mount($id)
    {
        $this->planId = $id;
    }

    public function openPlanDetailModal($id)
    {
        $this->planDetailId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function delete()
    {
        PlanDetail::find($this->planDetailId)->delete();
        $this->dispatch('alert', type: 'success', message: 'Xóa thành công');
    }
}
