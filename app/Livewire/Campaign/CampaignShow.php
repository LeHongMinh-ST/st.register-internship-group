<?php

namespace App\Livewire\Campaign;

use App\Models\Campaign;
use Livewire\Component;

class CampaignShow extends Component
{
    public int|string $campaignId;

    public function render()
    {
        $campaign = Campaign::query()->find($this->campaignId);

        return view('livewire.campaign.campaign-show', [
            'campaign' => $campaign
        ]);
    }

    public function mount($id)
    {
        $this->campaignId = $id;
    }
}
