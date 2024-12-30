<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeacherDataImport;

class TeacherImport extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('livewire.teacher.teacher-import');
    }

    public function closeImportModal()
    {
        $this->dispatch('close-import-teacher-modal');
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'mimes:xlsx,xls',
            ],

        ];
    }

    public function submit()
    {
        $this->validate();

        try {
            Excel::import(new TeacherDataImport(), $this->file);
            $this->dispatch('alert', type: 'success', message: 'Import thành công!');
            $this->closeImportModal();
            $this->dispatch('refresh-teacher');
        }catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Import thất bại!');
        }
    }
}
