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
            'jogo' => $this->faker->firstName(),
            'inicio' => $this->faker->date(),
            'encerramento' => $this->faker->date(),
        ];
    }

}
