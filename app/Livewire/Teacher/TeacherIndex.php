<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Teacher;
use App\Common\Constants;
use Livewire\WithPagination;


class TeacherIndex extends Component
{
    use WithPagination;
    public $search;

    protected $listeners = [
        'refresh-teacher' => '$refresh'
    ];

    public function updatingSearch()
    {
        $this->resetPage('groupsPageOfficial');
    }

    public function render()
    {
        $teachers = Teacher::query()
        ->search($this->search)
        ->orderBy('code', 'asc')
        ->paginate(Constants::PER_PAGE, ['*'], 'groupsPageOfficial');
        return view('livewire.teacher.teacher-index' ,[
            'teachers' => $teachers,
        ]);
    }

    public function openImportTeacherModal()
    {
        $this->dispatch('open-import-teacher-modal');
    }
}
