<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'event_name'=>"Saját",
            'competition_id'=>1,
            'program_id'=>1
        ];
    }
}
