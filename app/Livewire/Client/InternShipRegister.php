<?php

namespace App\Livewire\Client;

use App\Enums\StepRegisterEnum;
use Livewire\Component;

class InternShipRegister extends Component
{
    public StepRegisterEnum $step = StepRegisterEnum::StepOne;

    public function render()
    {
        return view('livewire.client.intern-ship-register');
    }

    public function nextStepTwo()
    {
        $this->step = StepRegisterEnum::StepTwo;
    }
}
