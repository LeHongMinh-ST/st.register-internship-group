<?php

namespace App\Livewire\Group;

use App\Common\Constants;
use App\Exports\ExportGroupStudent;
use App\Exports\ResultExport;
use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class GroupIndex extends Component
{
    use WithPagination;


    public int|string $campaignId;

    public function render()
    {
        $groups = Group::query()
            ->where('campaign_id', $this->campaignId)
            ->with(['students', 'students.groupStudent'])
            ->orderBy('created_at', 'asc')
            ->paginate(Constants::PER_PAGE, ['*'], 'groupPage');

        return view('livewire.group.group-index', [
            'groups' => $groups
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
