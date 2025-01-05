<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Company;

class CompanyEdit extends Component
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
    public $id;

    public function render()
    {
        return view('livewire.company.company-edit');
    }

    public function mount():void 
    {
        $this->id = request()->id;
        $company = Company::query()->find($this->id);
        $this->name = $company->name;
        $this->address = $company->address;
        $this->phone = $company->phone;
        $this->email = $company->email;
        $this->description = $company->description;
    }

    public function update()
    {
        $this->validate();
        Company::where('id', $this->id)->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Cập nhật công ty thành công.');

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
