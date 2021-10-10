<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class AddPatient extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $address = '';
    public $mobile_number = '';
    public $gender = null;

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'email:filter|unique:patients,email',
    ];

    public function render()
    {
        return view('livewire.add-patient');
    }

    public function addPatient()
    {
        $validated = $this->validate();

        Patient::create(array_merge($validated, [
            'address' => $this->address,
            'mobile_number' => $this->mobile_number,
            'gender' => $this->gender,
        ]));

        $this->reset([
            'first_name', 'last_name', 'email', 'address', 'mobile_number', 'gender',
        ]);

        redirect()->route('patient');

        session()->flash("message", "Patient has been added.");
    }
}
