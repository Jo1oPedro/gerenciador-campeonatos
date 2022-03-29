<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CampeonatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->firstName(),
            'time1' => $this->faker->city(),
            'time2' => $this->faker->city(),
        ];
    }
}
