<?php

namespace App\Livewire\Group;

use App\Models\GroupOfficial;
use Livewire\Component;

class GroupOfficialMemberIndex extends Component
{

    public GroupOfficial $group;

    public function render()
    {
        return view('livewire.group.group-official-member-index');
    }

    public function mount(GroupOfficial $group)
    {
        $this->group = $group;
    }
}
