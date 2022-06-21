<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joc>
 */
class JocFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'nom' => $this->faker->name(),
            'durada' => $this->faker->randomNumber(),
            'foto' => $this->faker->name(),
            'id_sala' => $this->faker->randomNumber(),
            'remember_token' => Str::random(10),
        ];
    }
}
