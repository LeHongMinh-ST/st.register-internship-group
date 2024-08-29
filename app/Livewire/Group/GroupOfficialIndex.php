<?php

namespace App\Livewire\Group;

use App\Common\Constants;
use App\Models\GroupOfficial;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class GroupOfficialIndex extends Component
{
    use WithPagination;

    public int|string $campaignId;

    public string $search = '';

    protected $listeners = [
        'refresh-student-group' => '$refresh'
    ];

    public function updatingSearch()
    {
        $this->resetPage('groupsPageOfficial');
    }


    public function render()
    {

        $groups = GroupOfficial::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)
            ->with(['students', 'students.studentGroupOfficial', 'teacher'])
            ->orderBy('code', 'asc')
            ->paginate(Constants::PER_PAGE, ['*'], 'groupsPageOfficial');

        $groupAll = GroupOfficial::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)
            ->with(['students', 'students.studentGroupOfficial', 'teacher'])
            ->orderBy('created_at', 'asc')->get();

        $studentRegister = Student::query()
            ->whereIn('group_id', $groupAll->pluck('id')->toArray())
            ->count();

        return view('livewire.group.group-official-index', [
            'groups' => $groups,
            'studentRegister' => $studentRegister,
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function openImportGroupModal()
    {
        $this->dispatch('open-import-group-modal');
    }
}
