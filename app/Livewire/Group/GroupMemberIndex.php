<?php

namespace App\Livewire\Group;

use App\Common\Constants;
use App\Models\Group;
use Livewire\Component;

class GroupMemberIndex extends Component
{

    public Group $group;

    public function render()
    {
        return view('livewire.group.group-member-index');
    }


    public function mount(Group $group)
    {
        $this->group = $group;
    }

}
