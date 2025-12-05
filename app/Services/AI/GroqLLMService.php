<?php

namespace App\Services\AI;

use GuzzleHttp\Client;

class GroqLLMService
{
    protected Client $client;
    protected string $endpoint;
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.groq.key');
        $this->endpoint = config('services.groq.endpoint');
        $this->model = config('services.groq.model');

        $this->client = new Client([
            'timeout' => 12,
            'verify' => false,
        ]);
    }

    public function getRecommendations(array $context): array
    {
        if (!$this->apiKey) {
            logger()->warning('Groq API key missing — skipping LLM enhancement.');
            return [];
        }

        $prompt = $this->buildPrompt($context);

        $resp = $this->client->post($this->endpoint, [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a travel recommender AI scoring flights.'
                    ],
                    [
                        'role' => 'user',
                        'content' => trim($prompt)
                    ],
                ],
                'temperature' => 0.2,
            ],
        ]);

        $body = json_decode($resp->getBody()->getContents(), true);

        return $this->parseResponse($body);
    }


    protected function buildPrompt(array $context): string
    {
        $persona = $context['persona'] ?? 'Unknown';
        $recentBookings = json_encode($context['recent_bookings'], JSON_PRETTY_PRINT);
        $candidates = json_encode($context['candidates'], JSON_PRETTY_PRINT);

        return <<<PROMPT
        You are a travel recommendation engine. Analyze the user's travel history and suggest the best flights.

        User Persona:
        $persona

        Recent Bookings:
        $recentBookings

        Candidate Flights:
        $candidates

        Respond ONLY with a valid JSON array with the structure below — no explanation text outside the JSON:

        [
        {"flight_id": 17, "score": 0.82, "reason": "Cheapest and short layover"},
        {"flight_id": 5, "score": 0.63, "reason": "Matches destination and travel behavior"}
        ]
        PROMPT;
    }

    protected function parseResponse(array $body): array
    {
        $text = $body['choices'][0]['message']['content'] ?? '';

        // Extract JSON safely
        $json = json_decode($text, true);

        return is_array($json) ? $json : [];
    }
}
