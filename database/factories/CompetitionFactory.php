<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>"Saját verseny",
            'venue'=>"Kaposvár",
            'date'=>"2022-10-01",
            "discipline"=>"poniklub",
            "office"=>1
        ];
    }
}
