<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'program_id'=>1,
            'ordinal'=>1,
            'programpart'=>1,
            'letters'=>"X",
            'criteria'=>"X",
            'maxmark'=>10,
            "coefficient"=>1


        ];
    }
}
