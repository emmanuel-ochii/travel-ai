<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Airport;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    protected $model = Airport::class;

    public function definition(): array
    {
        return [
            'iata' => strtoupper($this->faker->unique()->lexify('???')),
            'icao' => strtoupper($this->faker->unique()->lexify('????')),
            'name' => $this->faker->city . ' International Airport',
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'timezone' => $this->faker->timezone,
        ];
    }
}
