<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use Livewire\Attributes\Validate;

class TeacherEditMaxGroupStudent extends Component
{
    #[Validate( as: 'số lượng nhóm hướng dẫn tối đa')]
    public int $max_student_group = 0;

    public function render()
    {
        return view('livewire.teacher.teacher-edit-max-group-student');
    }

    public function submit()
    {

    }

    public function rules(): array
    {
        return [
            'max_student_group' => [
                'required',
                'min:1',
                'numeric'
            ]
        ];
    }

    public function updatedMaxStudentGroup($value)
    {
        $this->max_student_group = (int) $value;
    }
}
