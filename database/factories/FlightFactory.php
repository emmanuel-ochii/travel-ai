<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        $origin = Airport::factory()->create();
        $destination = Airport::factory()->create();

        $departAt = $this->faker->dateTimeBetween('+1 days', '+10 days');
        $arriveAt = (clone $departAt)->modify('+' . rand(1, 12) . ' hours');

        return [
            'airline_id' => Airline::factory(),
            'flight_number' => strtoupper($this->faker->bothify('??###')),
            'origin_airport_id' => $origin->id,
            'destination_airport_id' => $destination->id,
            'depart_at' => $departAt,
            'arrive_at' => $arriveAt,
            'duration_minutes' => (int) (($arriveAt->getTimestamp() - $departAt->getTimestamp()) / 60),
            'stops' => $this->faker->numberBetween(0, 2),
            'base_price_cents' => $this->faker->numberBetween(50000, 250000),
            'currency' => 'USD',
        ];
    }
}
