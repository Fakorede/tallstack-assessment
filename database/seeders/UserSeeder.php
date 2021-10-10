<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = ((int)$this->command->ask('How many staff users would you like to create?', 100)) - 1;

        User::factory()->admin()->create();
        User::factory($count)->create();
    }
}
