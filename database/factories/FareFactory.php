<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fare;
use App\Models\Flight;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fare>
 */
class FareFactory extends Factory
{
    protected $model = Fare::class;

    public function definition(): array
    {
        return [
            'flight_id' => Flight::factory(),
            'fare_class' => $this->faker->randomElement(['economy', 'business', 'first']),
            'price_cents' => $this->faker->numberBetween(50000, 250000),
            'currency' => 'USD',
            'refundable' => $this->faker->boolean(50),
            'baggage_allowance' => $this->faker->randomElement(['15kg', '20kg', '30kg']),
            'rules_json' => json_encode([
                'changeable' => $this->faker->boolean(70),
                'refund_percentage' => $this->faker->numberBetween(0, 100)
            ]),
        ];
    }

}
