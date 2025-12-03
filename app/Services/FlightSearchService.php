<?php

namespace App\Services;

use App\Models\Flight;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;


class FlightSearchService
{

    protected $apiProvider;
    protected $cacheTtl;


    public function __construct(\App\Providers\FlightApiProvider $apiProvider = null)
    {
        $this->apiProvider = $apiProvider ?: app(\App\Providers\FlightApiProvider::class);
        $this->cacheTtl = 60; // seconds for dev; increase in production
    }

    /**
     * Search flights. This tries local DB first and falls back to provider.
     *
     * $params = [
     *   'origin' => 'LGW',
     *   'destination' => 'JFK',
     *   'depart_date' => '2026-01-10',
     *   'return_date' => null,
     *   'passengers' => 1,
     *   'class' => 'economy'
     * ]
     */
    public function search(array $params, int $perPage = 10): LengthAwarePaginator
    {
        $key = $this->cacheKey($params);

        return Cache::remember($key, $this->cacheTtl, function () use ($params, $perPage) {
            // Try local DB results
            $query = Flight::query()
                ->with(['airline', 'origin', 'destination'])
                ->whereHas('origin', fn($q) => $q->where('iata', $params['origin']))
                ->whereHas('destination', fn($q) => $q->where('iata', $params['destination']))
                ->whereDate('depart_at', $params['depart_date'])
                ->orderBy('base_price_cents', 'asc');

            $results = $query->paginate($perPage);

            // If no results, ask API provider
            if ($results->total() === 0) {
                $providerResults = $this->apiProvider->search($params);
                // Map provider results into LengthAwarePaginator-like object
                // For simplicity the provider returns array of flight arrays
                $items = collect($providerResults)->map(function ($f) {
                    // transform to a simple object
                    return (object) $f;
                });

                $page = request()->get('page', 1);
                $offset = ($page - 1) * $perPage;
                return new LengthAwarePaginator(
                    $items->slice($offset, $perPage)->values(),
                    $items->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
            }

            return $results;
        });
    }

    protected function cacheKey(array $params): string
    {
        ksort($params);
        return 'flight_search_' . md5(json_encode($params));
    }
}
