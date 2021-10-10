<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $systolic = rand(90, 120);
        $diastolic = rand(60, 80);

        return [
            'patient_id' => Patient::all()->random()->id,
            'bp_observation' => "systolic: {$systolic} mmHg, diastolic: {$diastolic} mmHg",
            'comment' => $this->faker->text(),
        ];
    }
}
