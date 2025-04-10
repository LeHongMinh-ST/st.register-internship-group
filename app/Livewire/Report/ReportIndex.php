<?php

namespace App\Livewire\Report;

use Livewire\Component;
use App\Common\Constants;
use App\Models\GroupOfficial;
use App\Models\Campaign;

class ReportIndex extends Component
{
    public string $search = '';

    public function render()
    {
        $campaigns = Campaign::query()
        ->search($this->search)
        ->paginate(Constants::PER_PAGE_ADMIN);
        return view('livewire.report.report-index', [
            'campaigns' => $campaigns,
        ]);
    }
}
