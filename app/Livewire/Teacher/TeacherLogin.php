<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

class TeacherLogin extends Component
{
    #[Validate(as: 'Mã giảng viên')]
    public $code;

    #[Validate(as: 'Mật khẩu')]
    public string $password = '';

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function render()
    {
        return view('livewire.teacher.teacher-login');
    }

    protected $rules = [
        'code' => 'required|exists:teachers,code',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();
        $teacher = Teacher::where('code', $this->code)->first();

        if (!$teacher || !Hash::check($this->password, $teacher->password)) {
            $this->dispatch('alert', type: 'error', message: 'Mã giảng viên hoặc mật khẩu chưa đúng.');
            return;
        }
        // Đăng nhập giảng viên
        Auth::guard('teacher')->login($teacher);
        return redirect()->route('teacher.student-groups-campaign');
    }

    
}
