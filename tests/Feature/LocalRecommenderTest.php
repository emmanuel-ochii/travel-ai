<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Flight;
use App\Models\Fare;
use App\Models\Airline;
use App\Models\Airport;
use App\Services\AI\LocalRecommender;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocalRecommenderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_sorted_recommendations()
    {
        // Create airline & airports
        $airline = Airline::factory()->create();
        $origin = Airport::factory()->create(['iata' => 'LOS']);
        $destination = Airport::factory()->create(['iata' => 'LHR']);

        // Create 5 flights with fares
        Flight::factory()->count(5)->create([
            'airline_id' => $airline->id,
            'origin_airport_id' => $origin->id,
            'destination_airport_id' => $destination->id,
            'depart_at' => now()->addDays(1),
            'arrive_at' => now()->addDays(1)->addHours(6),
            'duration_minutes' => 360,
            'base_price_cents' => 100000,
            'flight_number' => 'LA123',
        ])->each(function ($flight) {
            Fare::factory()->create([
                'flight_id' => $flight->id,
                'price_cents' => rand(50000, 250000),
            ]);
        });

        $service = new LocalRecommender();
        $results = $service->recommend('LOS', 'LHR', 5);

        $this->assertNotEmpty($results, 'Recommendation results should not be empty');
        $this->assertLessThanOrEqual(5, $results->count(), 'Should not return more than requested limit');
    }
}
