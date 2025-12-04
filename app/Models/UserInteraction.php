<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserInteraction extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'type',    // search, view, book, feedback
        'payload', // JSON for details
        'ip',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log a user interaction.
     */
    public static function log(string $type, array $payload = [], ?\Illuminate\Http\Request $request = null)
    {
        $request ??= request();

        return self::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'payload' => $payload,
            'ip' => $request->ip(),
            'user_agent' => substr($request->userAgent() ?? '', 0, 500),
            'created_at' => now(),
        ]);
    }
}
