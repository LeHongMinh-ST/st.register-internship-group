<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Company;

class CompanyCreate extends Component
{
    #[Validate(as: 'Tên công ty')]
    public $name;

    #[Validate(as: 'Địa chỉ')]
    public $address;

    #[Validate(as: 'Số điện thoại')]
    public $phone;

    #[Validate(as: 'Mô tả')]
    public $description;

    #[Validate(as: 'Email')]
    public $email;


    public function render()
    {
        return view('livewire.company.company-create');
    }

    public function store()
    {
        $this->validate();

        Company::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Thêm mới công ty thành công.');

        return redirect()->route('admin.companies.index');
    }

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!preg_match("/^[0-9]{10}$/", $value)) {
                        return $fail('Số điện thoại chưa đúng định dạng ');
                    }
                }
            ],
            'description' => 'required|string',
            'email' => 'required|email',
        ];
    }   
}
