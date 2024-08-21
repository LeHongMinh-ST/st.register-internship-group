<?php

namespace App\Livewire\Group;

use App\Common\Constants;
use App\Exports\ExportGroupStudent;
use App\Models\Group;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class GroupIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public int|string $campaignId;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $groups = Group::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)
            ->with(['students', 'students.groupStudent'])
            ->orderBy('created_at', 'asc')
            ->paginate(Constants::PER_PAGE);

        $studentRegister = Student::query()->where('campaign_id', $this->campaignId)
            ->whereNotNull('group_id')->count();

        return view('livewire.group.group-index', [
            'groups' => $groups,
            'studentRegister' => $studentRegister,
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function export()
    {
        return Excel::download(new ExportGroupStudent($this->campaignId), 'kq-dang-ky-nhom-thuc-tap.xlsx');
    }
}
