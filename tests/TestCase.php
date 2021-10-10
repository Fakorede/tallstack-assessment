<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function user()
    {
        $this->create_roles();
        $user = User::factory(['role_id' => 1])->admin()->create();
        return $user;
    }

    protected function nurse_user()
    {
        $this->create_roles();
        $user = User::factory(['role_id' => 2])->create();
        return $user;
    }

    protected function doctor_user()
    {
        $this->create_roles();
        $user = User::factory(['role_id' => 3])->create();
        return $user;
    }

    protected function create_roles()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin'],
            ['name' => 'Nurse'],
            ['name' => 'Doctor'],
        ]);
    }
}
