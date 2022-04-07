<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Time;

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
            'idade' => $this->faker->numberBetween($min = 14,$max = 70),
            'nacionalidade' => $this->faker->city(),
            'vitorias' => rand(1, 100),
            'derrotas' => rand(1, 100),
            'time_id' => $this->faker->numberBetween(1, Time::all()->count())
        ];
    }
}
