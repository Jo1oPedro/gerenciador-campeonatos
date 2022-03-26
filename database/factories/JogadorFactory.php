<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JogadorFactory extends Factory
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
            'idade' => $this->faker->numberBetween($min = 1,$max = 115),
            //'time' => $this->faker->firstName(),
            'nacionalidade' => $this->faker->city(),
            //'time' => $this->faker->city(),
        ];
    }
}
