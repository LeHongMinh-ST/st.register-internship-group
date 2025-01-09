<?php

namespace App\Livewire\Plan;

use App\Common\Constants;
use App\Models\Plan;
use Livewire\Component;

class PlanIndex extends Component
{
    public string $search = '';
    public int|string $planId;

    protected $listeners = [
        'deletePlan' => 'delete',
    ];

    public function render()
    {
        $plans = Plan::query()
            ->search($this->search)
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.plan.plan-index')->with([
            'plans' => $plans,
        ]);
    }

    public function openDeleteModal($id)
    {
        $this->planId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function delete()
    {
        Plan::find($this->planId)->delete();
        $this->dispatch('alert', type: 'success', message: 'Xóa thành công');
    }
}
