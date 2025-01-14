<?php

namespace App\Livewire\CompanyCampaign;

use App\Models\Campaign;
use Livewire\Component;

class CompanyCampaignIndex extends Component
{
    public function render()
    {
        $campaigns = Campaign::all();

        return view('livewire.company-campaign.company-campaign-index')->with([
            'campaigns' => $campaigns
        ]);
    }
}
