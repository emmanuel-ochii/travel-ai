<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Airline;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airline>
 */
class AirlineFactory extends Factory
{
    protected $model = Airline::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('??')),
            'name' => $this->faker->company,
            'logo_url' => $this->faker->imageUrl(100, 100, 'transport', true, 'Airline'),
        ];
    }
}
