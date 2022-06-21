<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
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
            'nom' => $this->faker->name,
            'correu' => $this->faker->name,
            'telefon' => $this->faker->name,
            'pais' => $this->faker->name,
            'data' => $this->faker->date,
            'id_joc' => $this->faker->randomNumber(),
            'accept' => $this->faker->boolean,
            'remember_token' => Str::random(10),
        ];
    }
}
