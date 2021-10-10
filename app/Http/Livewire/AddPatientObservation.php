<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class AddPatientObservation extends Component
{
    public $bp_observation;
    public $comment = '';

    protected $rules = [
        'bp_observation' => 'required',
    ];

    public function render()
    {
        return view('livewire.add-patient-observation');
    }

    public function addPatientObservation($id)
    {
        $this->validate();

        $patient = Patient::whereId($id)->first();

        $patient->records()->create([
            'bp_observation' => $this->bp_observation,
            'comment' => $this->comment,
        ]);

        $this->reset([
            'bp_observation', 'comment',
        ]);

        redirect()->route('patient');

        session()->flash("message", "Patient Observation has been recorded.");
    }
}
