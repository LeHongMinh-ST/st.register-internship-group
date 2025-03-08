<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Livewire\Attributes\Validate;


class TeacherLogin extends Component
{
    #[Validate(as: 'Mã giảng viên')]
    public $code;

    #[Validate(as: 'Ngày sinh')]
    public string $dob = '';

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function updateDob($value): void
    {
        if ($value) {
            $this->resetValidation('dob');
        }
        $this->dob = str_replace('/', '-', $value);
    }

    protected $listeners = [
        'update-dob' => 'updateDob',
    ];

    public function render()
    {
        return view('livewire.teacher.teacher-login');
    }

    protected $rules = [
        'code' => 'required|exists:teachers,code',
        'dob' => 'required',
    ];

    public function login()
    {
        $this->validate();
        // dd($this->dob);

        // Chuyển đổi ngày sinh từ dd/mm/yyyy -> yyyy-mm-dd
        // $dobParts = explode('/', $this->dob);
        // $formattedDob = "{$dobParts[2]}-{$dobParts[1]}-{$dobParts[0]}";

        $formattedDob = \Carbon\Carbon::createFromFormat('d-m-Y', $this->dob)->format('Y-m-d');


        $teacher = Teacher::where('code', $this->code)
            ->whereDate('dob', $formattedDob)
            ->first();

        if ($teacher) {
            Auth::guard('teacher')->login($teacher);
            return redirect()->route('teacher.student-groups-campaign');
        }

        $this->dispatch('alert', type: 'error', message: 'Mã giảng viên hoặc ngày sinh không đúng.');   
    }

    
}
