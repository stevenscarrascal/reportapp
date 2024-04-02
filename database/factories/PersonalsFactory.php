<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\vs_tipo_documento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personals>
 */
class PersonalsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_documento' => vs_tipo_documento::all()->random()->id,
            'numero_documento' => $this->faker->randomNumber(),
            'nombres' => $this->faker->name(),
            'apellidos' => $this->faker->lastName(),
            'telefono' => $this->faker->phoneNumber(),
            'correo' => $this->faker->unique()->safeEmail(),
            'estado' => '3',
        ];
    }
}
