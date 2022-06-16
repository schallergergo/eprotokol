<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'discipline'=>"poniklub",
            'name'=>"Program",
            'numofblocks'=>10,
            'maxMark'=>10,
            'typeofevent'=>"normal",
            'doublesided'=>0,
            'active'=>1
        ];
    }
}
