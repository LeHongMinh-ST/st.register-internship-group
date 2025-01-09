<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PlanCreate extends Component
{
    #[Validate(as: 'bản mẫu kế hoạch')]
    public string $name = '';

    #[Validate(as: 'mô tả')]
    public string $description = '';

    public bool $isLoading = false;

    public function render()
    {
        return view('livewire.plan.plan-create');
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function submit(): RedirectResponse|Redirector|null
    {
        $this->validate();

        if (!$this->isLoading) {
            $this->isLoading = true;

            try {
                Plan::create([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);
                session()->flash('success', 'Tạo mới thành công!');
                $this->isLoading = false;
                return redirect()->route('admin.plans.index');
            } catch (\Exception $e) {
               $this->dispatch('alert', type: 'error', message: 'Tạo mới thất bại!');
               Log::error('Error create plan', [
                   'method' => __METHOD__,
                   'message' => $e->getMessage(),
               ]);
            }
        }
        $this->isLoading = false;

        return null;
    }
}
