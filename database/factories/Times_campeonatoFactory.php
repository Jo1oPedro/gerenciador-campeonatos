<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Times_campeonatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'time_id' => rand(1, 16),
            'campeonato_id' => rand(1,16),
        ];
    }
}
