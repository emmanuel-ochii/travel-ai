<?php

namespace App\Services;

use GuzzleHttp\Client;

class LLMService
{
    protected Client $client;
    protected string $endpoint;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->client = new Client(['timeout' => 10]);
        $this->endpoint = config('services.llm.endpoint'); // set in services.php/env
        $this->apiKey = config('services.llm.key');
    }

    /**
     * Send prompt to LLM and return parsed JSON or text.
     * For safety, expect the LLM to return JSON with an array of flight ids and scores/reasons
     */
    public function getRecommendations(array $context): array
    {
        // context contains user persona, top routes, recent searches, candidate flights (small)
        $payload = [
            'prompt' => $this->buildPrompt($context),
            // other provider-specific fields...
        ];

        // Replace with the HTTP format your provider requires
        $resp = $this->client->post($this->endpoint, [
            'headers' => [
                'Authorization' => $this->apiKey ? "Bearer {$this->apiKey}" : '',
                'Accept' => 'application/json',
            ],
            'json' => $payload,
        ]);

        $body = json_decode($resp->getBody()->getContents(), true);

        // Parse/normalize the response. Return array of suggestions structured as:
        // [ ['flight_id'=>123, 'score'=>0.9, 'reason'=>'match for luxury'], ... ]
        return $this->parseResponse($body);
    }

    protected function buildPrompt(array $context): string
    {
        // Keep this generic — craft a prompt describing user persona, recent bookings, and ask for top 5 flights.
        return "User persona: {$context['persona']}\nRecent bookings: " . json_encode($context['recent_bookings']) . "\nCandidate flights: " . json_encode($context['candidates']) . "\nReturn JSON of top 5 recommendations with flight_id, score (0-1), reason.";
    }

    protected function parseResponse($body): array
    {
        // Provider dependent — implement robust parsing and validation here.
        if (isset($body['recommendations']) && is_array($body['recommendations'])) {
            return $body['recommendations'];
        }

        return [];
    }
}
