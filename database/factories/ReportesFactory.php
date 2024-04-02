<?php

namespace Database\Factories;

use App\Models\reportes;
use App\Models\vs_anomalias;
use App\Models\vs_imposibilidad;
use App\Models\vs_comercios;
use App\Models\personals;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReportesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reportes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contrato' => $this->faker->randomNumber(),
            'medidor' => $this->faker->randomNumber(),
            'lectura' => $this->faker->randomNumber(),
            'personal_id' => personals::all()->random()->id,
            'anomalia' => json_encode(vs_anomalias::all()->random(5)->pluck('id')->toArray()),
            'imposibilidad' => vs_imposibilidad::all()->random()->id,
            'direccion' => $this->faker->address(),
            'latitud' => $this->faker->latitude(),
            'longitud' => $this->faker->longitude(),
            'tipo_comercio' => vs_comercios::all()->random()->id,
            'foto1' => $this->faker->image('public/imagen',640,480, null, false),
            'created_at' => $this->faker->dateTimeBetween('now'),
        ];
    }
}
