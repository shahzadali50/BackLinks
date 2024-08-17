<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class DomainMetricsService
{
    protected $apiUrl = 'https://domain-metrics-check.p.rapidapi.com/domain-metrics/';
    protected $headers;

    public function __construct()
    {
        $this->headers = [
            'x-rapidapi-host' => 'domain-metrics-check.p.rapidapi.com',
            'x-rapidapi-key' => env('RAPIDAPI_KEY'), // Ensure you have your RapidAPI key in the .env file
        ];
    }

    /**
     * Fetch domain metrics from the API.
     *
     * @param string $domain
     * @return array|null
     */
    public function fetchMetrics(string $domain)
    {
        try {
            // Send GET request to the API
            $response = Http::withHeaders($this->headers)
                ->get($this->apiUrl . $domain);

            // Check if the response is successful
            if ($response->successful()) {
                return $response->json(); // Return the JSON response
            } else {
                // Log the error response
                Log::error('API Request failed', [
                    'domain' => $domain,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
                return null;
            }
        } catch (Exception $e) {
            // Log any exceptions that occur during the request
            Log::error('Exception occurred while fetching domain metrics', [
                'domain' => $domain,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }
}
