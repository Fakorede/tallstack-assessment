<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class AddStaff extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $address = '';
    public $mobile_number = '';
    public $gender = null;
    public $role_id;

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'email:filter|unique:users,email',
        'role_id' => 'required',
    ];

    public function render()
    {
        return view('livewire.add-staff', [
            'roles' => Role::all()
        ]);
    }

    public function addStaff()
    {
        $validated = $this->validate();

        User::create(array_merge($validated, [
            'address' => $this->address,
            'mobile_number' => $this->mobile_number,
            'gender' => $this->gender,
        ]));

        $this->reset([
            'first_name', 'last_name', 'email', 'address', 'mobile_number', 'gender', 'role_id',
        ]);

        redirect()->route('staff');

        session()->flash("message", "Staff has been added.");
    }
}
