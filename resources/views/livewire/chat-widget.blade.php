
<div id="livewire-chat-root" data-livewire-chat="1" wire:ignore.self>
    {{-- Styles (component-scoped) --}}
    <style>
        /* Ensure root is not interfering with layout */
        #livewire-chat-root {
            all: initial;
        }

        #livewire-chat-root * {
            box-sizing: border-box;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        /* Floating button */
        .chat-float-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.24);
            z-index: 99999;
            cursor: pointer;
            transition: transform .16s ease, box-shadow .16s ease;
        }

        .chat-float-btn:hover {
            transform: translateY(-3px) scale(1.02);
        }

        /* Panel */
        .chat-panel {
            position: fixed;
            bottom: 100px;
            right: 24px;
            width: 360px;
            max-width: calc(100% - 48px);
            height: 520px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.12);
            display: none;
            z-index: 99999;
            overflow: hidden;
            transform-origin: bottom right;
            font-size: 14px;
            color: #0f172a;
        }

        .chat-panel.open {
            display: flex;
            flex-direction: column;
            animation: panelIn .18s ease;
        }

        @keyframes panelIn {
            from {
                transform: translateY(8px) scale(.98);
                opacity: 0
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1
            }
        }

        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-bottom: 1px solid #eef2ff;
            background: linear-gradient(180deg, #f8fafc, #fff);
        }

        .chat-title {
            font-weight: 600;
            color: #0f172a;
        }

        .chat-close {
            background: transparent;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #475569;
        }

        .chat-body {
            padding: 12px;
            overflow: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: linear-gradient(180deg, #fff, #fbfbff);
        }

        .message {
            display: flex;
            gap: 8px;
            align-items: flex-end;
        }

        .message.user {
            justify-content: flex-end;
        }

        .message.assistant .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #4f46e5;
        }

        .bubble {
            max-width: 78%;
            padding: 10px 12px;
            border-radius: 12px;
            background: #f8fafc;
            color: #0f172a;
            line-height: 1.35;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .message.user .bubble {
            background: #4f46e5;
            color: #fff;
            border-bottom-right-radius: 6px;
        }

        .typing-dots {
            display: inline-flex;
            gap: 6px;
            width: 46px;
            align-items: center;
            justify-content: center
        }

        .typing-dots span {
            width: 8px;
            height: 8px;
            background: #c7d2fe;
            border-radius: 50%;
            display: inline-block;
            animation: bounce 1s infinite;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: .15s
        }

        .typing-dots span:nth-child(3) {
            animation-delay: .3s
        }

        @keyframes bounce {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-6px)
            }

            100% {
                transform: translateY(0)
            }
        }

        .chat-input {
            padding: 12px;
            border-top: 1px solid #eef2ff;
            display: flex;
            gap: 8px;
            background: #fff;
        }

        .chat-input input {
            flex: 1;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #e6edf8;
            font-size: 14px;
            outline: none;
        }

        .chat-input button {
            padding: 10px 12px;
            border-radius: 10px;
            background: #4f46e5;
            color: #fff;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }

        /* small screens adjustments */
        @media (max-width:420px) {
            .chat-panel {
                right: 12px;
                left: 12px;
                width: auto;
                bottom: 88px;
                height: 60vh
            }

            .chat-float-btn {
                right: 12px;
                bottom: 20px;
            }
        }
    </style>
        {{-- Floating button --}}
        <div class="chat-float-btn" wire:click.prevent="toggle" role="button" aria-label="Open chat">
            <!-- comment: icon kept inline to avoid external assets -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" width="28" height="28"
                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>

        {{-- Chat panel --}}
        <div class="chat-panel {{ $open ? 'open' : '' }}">
            <div class="chat-header">
                <div class="chat-title">TravelAI</div>
                <button class="chat-close" wire:click.prevent="toggle" aria-label="Close chat">✕</button>
            </div>

            <div class="chat-body" id="chat-body" role="log" aria-live="polite">
                @foreach ($messages as $msg)
                    <div class="message {{ $msg['role'] === 'user' ? 'user' : 'assistant' }}" id="{{ $msg['id'] }}">
                        @if ($msg['role'] === 'assistant')
                            <div class="avatar" aria-hidden="true">T</div>
                        @endif

                        <div class="bubble">
                            @if (!empty($msg['typing']))
                                <div class="typing-dots" aria-hidden="true">
                                    <span></span><span></span><span></span>
                                </div>
                            @else
                                {!! nl2br(e($msg['text'])) !!}
                            @endif
                        </div>

                        @if ($msg['role'] === 'user')
                            <div class="spacer"></div>
                        @endif
                    </div>
                @endforeach
            </div>

            <form class="chat-input" wire:submit.prevent="send" role="form" aria-label="Send message">
                <input type="text" placeholder="Ask about destinations, budgets, or seasons..."
                    wire:model.defer="input" wire:keydown.enter.prevent="send" aria-label="Message input" />
                <button type="submit" aria-label="Send message">Send</button>
            </form>
        </div>

    </div>
@push('scripts')
    {{-- JS: portal-to-body + scroll handlers + Livewire events --}}
    <script>
        (function() {
            // Move this component's root node to document.body so fixed positioning ALWAYS anchors to viewport
            function portalChatRoot() {
                try {
                    const root = document.querySelector('#livewire-chat-root[data-livewire-chat="1"]');
                    if (!root) return;
                    // avoid re-appending if already moved
                    if (root.__movedToBody) return;
                    document.body.appendChild(root);
                    root.__movedToBody = true;
                } catch (e) {
                    // not fatal; widget will still render inline
                    console.warn('chat widget portal error', e);
                }
            }

            // Scroll chat body to bottom
            function scrollChatBottom() {
                setTimeout(() => {
                    const el = document.getElementById('chat-body');
                    if (el) el.scrollTop = el.scrollHeight;
                }, 50);
            }

            // Wait for Livewire to be ready, then portal and bind events
            document.addEventListener('livewire:load', function() {
                portalChatRoot();

                // Ensure portal on subsequent Livewire DOM swaps
                Livewire.hook('message.processed', (el, component) => {
                    portalChatRoot();
                });

                // Listen for custom events from Livewire backend
                window.addEventListener('scroll-chat-bottom', scrollChatBottom);
                Livewire.on('scroll-chat-bottom', scrollChatBottom);

                // Also respond to chat toggled event (if you want to focus input when opened)
                window.addEventListener('chat-toggled', function(e) {
                    if (e.detail && e.detail.open) {
                        // focus input if present
                        setTimeout(() => {
                            const input = document.querySelector(
                                '#livewire-chat-root input[aria-label="Message input"]');
                            if (input) input.focus();
                            scrollChatBottom();
                        }, 150);
                    }
                });
            });

            // If Livewire not present (rare), portal on DOMContentLoaded
            document.addEventListener('DOMContentLoaded', portalChatRoot);
        })();
    </script>
@endpush
