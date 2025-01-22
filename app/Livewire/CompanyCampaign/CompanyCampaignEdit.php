<?php

namespace App\Livewire\CompanyCampaign;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CompanyCampaignEdit extends Component
{
    public $companyId;
    public $campaignId;
    public $amount;
    public $jobDescription;
    public $amountRecruited;

    public function mount($companyId, $campaignId)
    {
        $this->companyId = $companyId;
        $this->campaignId = $campaignId;

        $company = DB::table('campaign_company')
            ->where('company_id', $this->companyId)
            ->where('campaign_id', $this->campaignId)
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

        $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công! Hãy bấm tải lại dữ liệu');
    }
}
