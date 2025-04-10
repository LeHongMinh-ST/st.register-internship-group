<?php

namespace App\Livewire\Teacher\Account;

use Livewire\Component;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;


class AccountUpdate extends Component
{
    #[Validate( as: 'mật khẩu mới')]
    public $password;
    #[Validate( as: 'nhập lại mật khẩu mới')]
    public $retypePassword;

    protected $rules = [
        'password' => 'required|min:5',
        'retypePassword' => 'required|same:password',
    ];
    
    
    public function render()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('livewire.teacher.account.account-update', compact('teacher'));
    }

    public function changePassword()
    {
        $this->validate();

        $teacherId = Auth::guard('teacher')->id();

        Teacher::where('id', $teacherId)->update([
            'password' => bcrypt($this->password),
        ]);
        
        session()->flash('success', 'Đổi mật khẩu thành công!');
        $this->reset(['password', 'retypePassword']);
        return redirect()->route('teacher.account');

    }
}
