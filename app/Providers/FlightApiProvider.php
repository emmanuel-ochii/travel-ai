<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use GuzzleHttp\Client;

class FlightApiProvider extends ServiceProvider
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.flight_api.base_url') ?: null;
        $this->apiKey = config('services.flight_api.key') ?: null;
        $this->client = new Client([
            'base_uri' => $this->baseUrl ?: null,
            'timeout' => 10,
        ]);
    }

    /**
     * Mockable method to perform remote search.
     * Return array of flights in simple structure if provider is configured.
     */
    public function search(array $params): array
    {
        // If not configured, return empty array. In production implement provider API calls.
        if (!$this->baseUrl) {
            return [];
        }

        $resp = $this->client->get('/search', [
            'query' => $params,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey
            ]
        ]);

        $data = json_decode($resp->getBody()->getContents(), true);
        return $data['flights'] ?? [];
    }
}
