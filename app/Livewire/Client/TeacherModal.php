<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Teacher;

class TeacherModal extends Component
{
    public function render()
    {
        $teachers = Teacher::query()
        ->where('status', \App\Enums\TeacherStatusEnum::Accept->value) 
        ->orderBy('name')
        ->get();
        return view('livewire.client.teacher-modal', [
            'teachers' => $teachers,
        ]);
    }
}
