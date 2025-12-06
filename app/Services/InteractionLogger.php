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
    // public static function log(string $type, array $payload = [], ?Request $request = null)
    // {
    //     $request ??= request();

    //     return UserInteraction::create([
    //         'user_id' => Auth::id(),
    //         'type' => $type,
    //         'payload' => $payload,
    //         'ip' => $request->ip(),
    //         'user_agent' => substr($request->userAgent() ?? '', 0, 500),
    //         'created_at' => now(),
    //     ]);
    // }



    public static function log(string $type, array $payload = [], ?Request $request = null)
    {
        $request ??= request();
        $userId = Auth::id();

        // Minimal payload sanitization + truncate
        $payloadJson = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        // limit to 1500 chars to avoid huge columns unless explicitly allowed
        if (strlen($payloadJson) > 1500) {
            $payloadJson = substr($payloadJson, 0, 1500) . '...';
        }

        // Build a dedupe key to avoid duplicate logs in a short timeframe
        $dedupeKey = 'interaction_dedupe:' . md5("u:{$userId}|t:{$type}|p:{$payloadJson}");
        if (Cache::add($dedupeKey, true, 10)) {
            $recordData = [
                'user_id' => $userId,
                'type' => $type,
                // store as JSON string in DB payload column (DB field probably json/text)
                'payload' => $payloadJson,
                'created_at' => now(),
            ];

            // Optionally include ip and user_agent when allowed or in non-production
            if (config('app.log_extra_interaction', false)) {
                $recordData['ip'] = $request->ip();
                $recordData['user_agent'] = substr($request->userAgent() ?? '', 0, 500);
            }

            return UserInteraction::create($recordData);
        }

        // If we've recently logged identical payload, skip duplicate
        return null;
    }
}
