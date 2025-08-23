<?php

namespace App\Livewire\Topic;

use Livewire\Component;
use App\Common\Constants;
use App\Models\Campaign;
use Livewire\WithPagination;

class TopicIndex extends Component
{
    use WithPagination;
    
    public string $search = '';

    public function render()
    {
        $campaigns = Campaign::query()
            ->search($this->search)
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::PER_PAGE_ADMIN);
        return view('livewire.topic.topic-index', [
            'campaigns' => $campaigns,
        ]);
    }
}
