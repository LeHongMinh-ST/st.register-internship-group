<?php

namespace App\Livewire\CompanyCampaign;

use App\Common\Constants;
use App\Enums\RecruitmentStatusEnum;
use App\Models\Campaign;
use App\Models\Company;
use Livewire\Component;

class CompanyCampaignShow extends Component
{
    public $campaignId;
    public $selectedCompanies = []; // Lưu danh sách công ty được chọn

    protected $listeners = ['refresh' => '$refresh'];

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
        // Lấy các công ty đã được gán cho chiến dịch
        $this->selectedCompanies = Campaign::find($this->campaignId)
            ->companies()
            ->select('companies.id') // Chỉ định rõ cột `id` từ bảng `companies`
            ->pluck('id')
            ->toArray();
    }

    // Xử lý khi checkbox thay đổi
    public function toggleCompany($companyId)
    {
        $campaign = Campaign::find($this->campaignId);

        if (in_array($companyId, $this->selectedCompanies)) {
            // Nếu đã chọn, bỏ gắn (detach)
            $campaign->companies()->detach($companyId);
            $this->selectedCompanies = array_diff($this->selectedCompanies, [$companyId]);
        } else {
            // Nếu chưa chọn, gắn vào (attach)
            $campaign->companies()->attach($companyId, [
                'amount' => 0, // Giá trị mặc định
                'job_description' => '', // Giá trị mặc định
                'amount_recruited' => 0, // Giá trị mặc định
            ]);
            $this->selectedCompanies[] = $companyId;
        }
    }

    public function render()
    {
        $companies = Campaign::find($this->campaignId)->companies()->paginate(Constants::PER_PAGE_ADMIN);
        $companies_all = Company::query()->where('status', RecruitmentStatusEnum::Open)->get();
        return view('livewire.company-campaign.company-campaign-show')->with([
            'companies' => $companies,
            'companies_all' => $companies_all,
        ]);
    }

    public function openModal()
    {
        $this->dispatch('open-import-modal');
    }
}
