<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class StartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "id"=>rand(1,1000000), 
            "event_id"=>1,
            "rider_id"=>rand(10000,100000),
            "rider_name"=> "Rider",
            "horse_id"=>rand(10000,100000),
            "horse_name"=>"horse",
            "club"=>"Pony Klub",
            "category"=>"Kezdő",
            "original_category"=>"Kezdő",
            "rank"=>rand(1,100),
            "mark"=>0,
            "percent"=>0,
            "collective"=>0,
            "completed"=>0,
            "public"=>0
        ];
    }
}
