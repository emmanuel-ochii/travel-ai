<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChatWidget extends Component
{
    public $open = false;
    public $messages = [];
    public $input = '';
    public $isTyping = false; // server-side typing flag

    protected $listeners = ['processAi' => 'handleAi'];

    public function mount()
    {
        // Seed an initial assistant greeting
        $this->messages = [
            [
                'id' => uniqid('m_'),
                'role' => 'assistant',
                'text' => 'Hi! I\'m TravelAI — ask me for destination ideas, seasonal tips, budgets or itineraries.',
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
        $userMessage = [
            'id' => uniqid('m_'),
            'role' => 'user',
            'text' => $text,
            'time' => now()->toDateTimeString(),
        ];
        $this->messages[] = $userMessage;
        $this->input = '';

        // Append a typing placeholder for assistant
        $typingId = uniqid('t_');
        $this->messages[] = [
            'id' => $typingId,
            'role' => 'assistant',
            'text' => '',
            'time' => now()->toDateTimeString(),
            'typing' => true,
        ];

        $this->isTyping = true;

        // Livewire 3: Dispatch to the component class itself to trigger 'handleAi'
        $this->handleAi($text, $typingId);

        // Scroll chat
        $this->dispatch('scroll-chat-bottom');
    }

    public function handleAi($userText, $typingId = null)
    {
        // Attempt AI call or return fallback
        $reply = $this->getAiReply($userText);

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

        // Scroll after a short delay on client
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

        $messagesPayload = [
            [
                'role' => 'system',
                'content' => 'You are TravelAI, a helpful travel recommendations assistant. Provide concise, friendly and actionable travel suggestions. When possible, include 2-4 options with a one-line reason each.'
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
        return "I don't have access to the AI engine right now{$errorMsg} — but here are 3 quick suggestions based on your request:

1) Try a nearby beach getaway (great for relaxation).
2) Check a capital city for culture + nightlife.
3) Consider a nature/resort stay if you want outdoors.

If you'd like, connect this chat to the Groq LLM by ensuring GROQ_API_KEY is correct, GROQ_MODEL is a valid model name, and the Groq service is active.";
    }

    public function render()
    {
        return view('livewire.chat-widget');
    }
}
