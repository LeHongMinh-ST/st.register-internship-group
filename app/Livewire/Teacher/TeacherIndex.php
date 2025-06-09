<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Teacher;
use App\Common\Constants;
use Livewire\WithPagination;
use App\Enums\TeacherStatusEnum;


class TeacherIndex extends Component
{
    use WithPagination;
    public $search;
    public int $teacherId;

    protected $listeners = [
        'refresh-teacher' => '$refresh',
        'deleteTeacher' => 'handleDeleteTeacher',
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
        return view('livewire.teacher.teacher-index', [
            'teachers' => $teachers,
        ]);
    }

    public function openImportTeacherModal()
    {
        $this->dispatch('open-import-teacher-modal');
    }

    public function accept($teacherId): void
    {
        $teacher = Teacher::find($teacherId);
        if ($teacher) {
            $teacher->status = TeacherStatusEnum::Accept->value;
            $teacher->save();
        }
    }

    public function refuse($teacherId): void
    {
        $teacher = Teacher::find($teacherId);
        if ($teacher) {
            $teacher->status = TeacherStatusEnum::Refuse->value;
            $teacher->save();
        }
    }

    public $selectedTeacher = null;

    public function teacherDetail($id): void
    {
        $this->selectedTeacher = Teacher::find($id);
    }

    public function handleDeleteTeacher(): void
    {
        Teacher::destroy($this->teacherId);
        $this->dispatch('alert', type: 'success', message: 'Xóa thành công');
    }

    public function openDeleteModal(int $id): void
    {
        $this->teacherId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function resetPassword($teacherId): void
    {
        $teacher = Teacher::find($teacherId);

        if ($teacher) {
            $teacher->password = bcrypt('Fita@2005');
            $teacher->save();

            $this->dispatch('alert', type: 'success', message: 'Đã đặt lại mật khẩu mặc định');
        }
    }
}
