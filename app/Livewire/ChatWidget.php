<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Flight;

class ChatWidget extends Component
{
    public $open = false;
    public $messages = [];
    public $input = '';
    public $isTyping = false;

    protected $listeners = ['processAi' => 'handleAi'];

    public function mount()
    {
        // Initial assistant greeting + usage guide
        $this->messages = [
            [
                'id' => uniqid('m_'),
                'role' => 'assistant',
                'text' => "Hi! I'm TravelAI — I can help you find flights, destinations, or travel tips.\n\n"
                    . "To get the best results, please type your requests like this:\n"
                    . "- Flights: 'Show me flights from [Origin City/Airport] to [Destination City/Airport] on [Date]'\n"
                    . "- Destinations: 'Suggest popular destinations in [Country/City] for [Month/Season]'\n"
                    . "- Itineraries/Budget: 'What is a good 3-day itinerary in [City] for [Budget]?'",
                'time' => now()->toDateTimeString(),
            ],
        ];
    }

    public function toggle()
    {
        $this->open = !$this->open;
        $this->dispatch('chat-toggled', ['open' => $this->open]);

        if ($this->open) {
            $this->dispatch('scroll-chat-bottom');
        }
    }

    public function send()
    {
        $text = trim($this->input);
        if ($text === '')
            return;

        // Append user message
        $this->messages[] = [
            'id' => uniqid('m_'),
            'role' => 'user',
            'text' => $text,
            'time' => now()->toDateTimeString(),
        ];
        $this->input = '';

        // Append typing placeholder
        $typingId = uniqid('t_');
        $this->messages[] = [
            'id' => $typingId,
            'role' => 'assistant',
            'text' => '',
            'time' => now()->toDateTimeString(),
            'typing' => true,
        ];

        $this->isTyping = true;

        $this->handleAi($text, $typingId);
        $this->dispatch('scroll-chat-bottom');
    }

    public function handleAi($userText, $typingId = null)
    {
        // Check if the prompt looks like a flight search
        if (stripos($userText, 'flight') !== false && !preg_match('/from .* to .* on .*/i', $userText)) {
            $reply = "It seems you want to search for flights. "
                . "Please type your request like this: 'Show me flights from [Origin City/Airport] to [Destination City/Airport] on [Date]'.";
        } else {
            $reply = $this->getAiReply($userText);
        }

        // Replace typing placeholder with actual reply
        foreach ($this->messages as $index => $m) {
            if (isset($m['id']) && $m['id'] === $typingId) {
                $this->messages[$index] = [
                    'id' => uniqid('m_'),
                    'role' => 'assistant',
                    'text' => $reply,
                    'time' => now()->toDateTimeString(),
                ];
                break;
            }
        }

        $this->isTyping = false;
        $this->dispatch('scroll-chat-bottom');
    }

    protected function getAiReply($prompt)
    {
        $config = config('services.groq');
        $apiKey = $config['key'] ?? null;
        $apiUrl = $config['endpoint'] ?? 'https://api.groq.com/openai/v1';
        $model = $config['model'] ?? 'llama-3.3-70b-versatile';

        if (!$apiKey || $apiKey === 'api_key') {
            return $this->fallbackReply($prompt, 'No valid API key loaded');
        }

        // --- Fetch flights from your DB ---
        $flights = Flight::with(['airline', 'origin', 'destination'])
            ->take(10)
            ->get();

        $flightsText = "Available flights in our app:\n";
        foreach ($flights as $f) {
            $flightsText .= sprintf(
                "- %s %s: %s -> %s departing %s, arriving %s, stops: %d, price: %s %s\n",
                $f->airline->name ?? 'Unknown Airline',
                $f->flight_number,
                $f->origin->code ?? 'N/A',
                $f->destination->code ?? 'N/A',
                $f->depart_at->format('Y-m-d H:i'),
                $f->arrive_at->format('Y-m-d H:i'),
                $f->stops,
                $f->currency,
                number_format($f->base_price_cents / 100, 2)
            );
        }

        $messagesPayload = [
            [
                'role' => 'system',
                'content' => 'You are TravelAI, a helpful travel recommendations assistant. Only recommend flights from the list below: ' . $flightsText
                    . ' If the user input is unclear, politely guide them on how to phrase their request.'
            ],
            [
                'role' => 'user',
                'content' => $prompt
            ]
        ];

        try {
            $resp = Http::withToken($apiKey)
                ->timeout(20)
                ->post($apiUrl, [
                    'model' => $model,
                    'messages' => $messagesPayload,
                    'max_tokens' => 400
                ]);

            if ($resp->successful()) {
                $json = $resp->json();
                if (isset($json['choices'][0]['message']['content'])) {
                    return trim($json['choices'][0]['message']['content']);
                }

                logger()->error('Groq API successful response but unexpected JSON', $json);
                return $this->fallbackReply($prompt, 'JSON format unexpected');
            }

            logger()->error('Groq API request failed', ['status' => $resp->status(), 'body' => $resp->body()]);
            return $this->fallbackReply($prompt, 'API Error (' . $resp->status() . ')');
        } catch (\Exception $e) {
            logger()->error('Groq API exception: ' . $e->getMessage());
            return $this->fallbackReply($prompt, 'Exception: ' . $e->getMessage());
        }
    }

    protected function fallbackReply($prompt, $errorDetail = null)
    {
        $errorMsg = $errorDetail ? " (Error: {$errorDetail})" : '';
        return "I don't have access to the AI engine right now{$errorMsg} — here are 3 quick suggestions based on your request:

        1) Try a nearby beach getaway (great for relaxation).
        2) Check a capital city for culture + nightlife.
        3) Consider a nature/resort stay if you want outdoors.

        If you'd like, connect this chat to the Groq LLM by ensuring GROQ_API_KEY is correct, GROQ_MODEL is valid, and the Groq service is active.";
    }

    public function render()
    {
        return view('livewire.chat-widget');
    }
}
