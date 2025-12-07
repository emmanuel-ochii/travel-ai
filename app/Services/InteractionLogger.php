<?php

namespace App\Services;

use App\Models\UserInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class InteractionLogger
{
    /**
     * Log a user interaction in a compact, controlled way.
     * - Truncates payloads to avoid huge DB entries.
     * - Avoids exact duplicate events within a short window (10s).
     * - Honors config('app.log_extra_interaction') to include user agent / ip if desired.
     *
     * @param string $type
     * @param array $payload
     * @param Request|null $request
     * @return UserInteraction|null
     */


    public static function log(string $type, array $payload = [], ?Request $request = null)
    {
        // Only log authenticated users
        $userId = Auth::id();
        if (!$userId) {
            return null; // Prevent guest spam logs
        }

        $request ??= request();

        // Sanitize + compact payload
        $payloadJson = json_encode(
            $payload,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        // Truncate if oversized
        $payloadJson = strlen($payloadJson) > 1500
            ? substr($payloadJson, 0, 1500) . '...'
            : $payloadJson;

        // Deduplication key (prevents repeated logs within 10 seconds)
        $dedupeKey = 'interaction:' . md5("u:$userId|t:$type|p:$payloadJson");
        if (!Cache::add($dedupeKey, true, 10)) {
            return null; // Already logged recently — skip
        }

        $record = [
            'user_id' => $userId,
            'type' => $type,
            'payload' => $payloadJson,
            'created_at' => now(),
        ];

        // Attach device info only when explicitly enabled
        if (config('app.log_extra_interaction', false)) {
            $record['ip'] = $request->ip();
            $record['user_agent'] = substr($request->userAgent() ?? '', 500);
        }

        return UserInteraction::create($record);
    }

}
