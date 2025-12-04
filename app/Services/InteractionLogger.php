<?php

namespace App\Services;

use App\Models\UserInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionLogger
{
    public static function log(string $type, array $payload = [], ?Request $request = null)
    {
        $request ??= request();

        return UserInteraction::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'payload' => $payload,
            'ip' => $request->ip(),
            'user_agent' => substr($request->userAgent() ?? '', 0, 500),
            'created_at' => now(),
        ]);
    }
}
