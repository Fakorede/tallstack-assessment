<?php

namespace Tests\Feature;

use App\Http\Livewire\AddStaff;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StaffTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_staff_page()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/staff')
            ->assertSuccessful()
            ->assertSeeText('Staff');
    }

    public function test_user_can_see_add_staff_page()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get('/staff/add')
            ->assertSuccessful()
            ->assertSeeText('Add Staff');
    }

    public function test_user_has_permission_to_add_staff_users()
    {
        $user = $this->user();
        $this->assertTrue($user->can('add-staff'));
    }

    public function test_nurse_user_does_not_have_permission_to_add_staff_users()
    {
        $user = $this->nurse_user();
        $this->assertTrue($user->cannot('add-staff'));
    }

    public function test_doctor_user_does_not_have_permission_to_add_staff_users()
    {
        $user = $this->doctor_user();
        $this->assertTrue($user->cannot('add-staff'));
    }

    public function test_admin_user_has_permission_to_export_staff_data()
    {
        $user = $this->user();
        $this->assertTrue($user->can('export-staff-data'));
    }

    public function test_nurse_user_does_not_have_permission_to_export_staff_data()
    {
        $user = $this->nurse_user();
        $this->assertTrue($user->cannot('export-staff-data'));
    }

    public function test_doctor_user_does_not_have_permission_to_export_staff_data()
    {
        $user = $this->doctor_user();
        $this->assertTrue($user->cannot('export-staff-data'));
    }

    public function test_staff_users_can_be_created()
    {
        $this->create_roles();

        $this->actingAs($this->user());

        Livewire::test(AddStaff::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('email', 'john@test.com')
            ->set('role_id', rand(1, 3))
            ->call('addStaff');

        $this->assertTrue(User::whereFirstName('John')->exists());
    }

    public function test_required_fields_when_adding_staff_users()
    {
        $this->actingAs($this->user());
 
        Livewire::test(AddStaff::class)
            ->set('first_name', '')
            ->set('last_name', '')
            ->set('email', '')
            ->call('addStaff')
            ->assertHasErrors([
                'first_name' => 'required',
                'last_name' => 'required',
                'role_id' => 'required',
            ]);
    }
}
