<?php

namespace Tests\Feature;

use App\Http\Livewire\AddPatient;
use App\Http\Livewire\AddPatientObservation;
use App\Models\Patient;
use App\Models\Record;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_patient_page()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/patient')
            ->assertSuccessful()
            ->assertSeeText('Patient');
    }

    public function test_user_can_see_add_patient_page()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/patient/add')
            ->assertSuccessful()
            ->assertSeeText('Add Patient');
    }

    public function test_user_can_see_add_patient_observation_page()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/patient/1/add-observation')
            ->assertSuccessful()
            ->assertSeeText('Record Patient Observation');
    }

    public function test_admin_user_has_permission_to_add_patient()
    {
        $user = $this->user();
        $this->assertTrue($user->can('add-patient'));
    }

    public function test_nurse_user_has_permission_to_add_patient()
    {
        $user = $this->nurse_user();
        $this->assertTrue($user->can('add-patient'));
    }

    public function test_doctor_user_has_permission_to_add_patient()
    {
        $user = $this->doctor_user();
        $this->assertTrue($user->can('add-patient'));
    }

    public function test_admin_user_has_permission_to_export_patient_data()
    {
        $user = $this->user();
        $this->assertTrue($user->can('export-patient-data'));
    }

    public function test_nurse_user_has_permission_to_export_patient_data()
    {
        $user = $this->nurse_user();
        $this->assertTrue($user->can('export-patient-data'));
    }

    public function test_doctor_user_has_permission_to_export_patient_data()
    {
        $user = $this->doctor_user();
        $this->assertTrue($user->can('export-patient-data'));
    }

    public function test_patients_can_be_created()
    {
        $this->actingAs($this->user());

        Livewire::test(AddPatient::class)
            ->set('first_name', 'Jane')
            ->set('last_name', 'Doe')
            ->set('email', 'john@test.com')
            ->call('addPatient');

        $this->assertTrue(Patient::whereFirstName('Jane')->exists());
    }

    public function test_required_fields_when_adding_patient()
    {
        $this->actingAs($this->user());
 
        Livewire::test(AddPatient::class)
            ->set('first_name', '')
            ->set('last_name', '')
            ->set('email', '')
            ->call('addPatient')
            ->assertHasErrors([
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
    }

    public function test_patients_observations_can_be_recorded()
    {
        $this->actingAs($this->user());
        $patient = Patient::factory()->create();

        Livewire::test(AddPatientObservation::class)
            ->set('bp_observation', 'systolic: 120 mmHg, diastolic: 180 mmHg')
            ->call('addPatientObservation', $patient->id);

        $this->assertTrue(Record::where('bp_observation', 'systolic: 120 mmHg, diastolic: 180 mmHg')->exists());
    }

    public function test_required_fields_when_recording_patient_observation()
    {
        $this->actingAs($this->user());
        $patient = Patient::factory()->create();
 
        Livewire::test(AddPatientObservation::class)
            ->set('bp_observation', '')
            ->call('addPatientObservation', $patient->id)
            ->assertHasErrors(['bp_observation' => 'required']);
    }
}
