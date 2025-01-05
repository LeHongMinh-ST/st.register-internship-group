<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Company;

class CompanyModal extends Component
{
    public function render()
    {
        $companies = Company::query()
        ->where('status', \App\Enums\RecruitmentStatusEnum::Open->value) 
        ->orderBy('name')
        ->get();
        return view('livewire.client.company-modal', [
            'companies' => $companies,
        ]);
    }
}
