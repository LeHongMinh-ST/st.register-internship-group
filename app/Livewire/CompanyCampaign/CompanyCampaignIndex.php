<?php

namespace App\Livewire\CompanyCampaign;

use App\Common\Constants;
use App\Models\Campaign;
use Livewire\Component;

class CompanyCampaignIndex extends Component
{
    public string $search = '';

    public function render()
    {
        $campaigns = Campaign::query()
            ->search($this->search)
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.company-campaign.company-campaign-index')->with([
            'campaigns' => $campaigns,
        ]);
    }
}
