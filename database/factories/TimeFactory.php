<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimeFactory extends Factory
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
            'pais_origem' => $this->faker->country(),
            'pontuacao' => rand(1, 100),
            'vitorias' => rand(1, 100),
            'derrotas' => rand(1, 100),
            //'campeonato_id' => rand(1, 16),
        ];
    }
}
