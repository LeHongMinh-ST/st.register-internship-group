<?php

namespace App\Livewire\CompanyCampaign;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CompanyCampaignEdit extends Component
{
    public $companyId;
    public $amount;
    public $jobDescription;
    public $amountRecruited;

    public function mount($companyId)
    {
        $this->companyId = $companyId;

        $company = DB::table('campaign_company')
            ->where('company_id', $this->companyId)
            ->first();
        $this->amount = $company->amount;
        $this->jobDescription = $company->job_description;
        $this->amountRecruited = $company->amount_recruited;
    }

    public function render()
    {
        $company = Company::find($this->companyId);
        return view('livewire.company-campaign.company-campaign-edit')->with([
            'company' => $company,
        ]);
    }

    public function update()
    {
        DB::table('campaign_company')
            ->where('company_id', $this->companyId)
            ->update([
                'amount' => $this->amount,
                'job_description' => $this->jobDescription,
                'amount_recruited' => $this->amountRecruited,
            ]);
        $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
        $this->dispatch('refresh');
    }
}
