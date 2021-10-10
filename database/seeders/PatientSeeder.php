<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Record;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    private $chunk_count = 10;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int)$this->command->ask('How many patient records would you like to create?', 50000);
        
        if ($count > 100 && $count < 1000) {
            $this->chunk_count = 100;
        } else if ($count > 1000) {
            $this->chunk_count = 1000;
        }
        
        $patients = Patient::factory($count)->make();
        $patients->chunk($this->chunk_count)->each(function($chunk) {
            DB::table('patients')->insert($chunk->toArray());
        });
        
    }
}
