<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfficialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id'=>1,
            'judge'=>"Vincze Zoltán",
            'penciler'=>2,
            'position'=>"C"
        ];
    }
}
