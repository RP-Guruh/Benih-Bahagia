<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TypesenseService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('typesense.protocol', 'http') . '://' . 
                         config('typesense.host', 'localhost') . ':' . 
                         config('typesense.port', 8108);
        $this->apiKey = config('typesense.api_key');
    }

    public function createCollection(array $schema)
    {
        return Http::withHeaders([
            'X-TYPESENSE-API-KEY' => $this->apiKey,
        ])->post($this->baseUrl . '/collections', $schema)->json();
    }

    public function addDocument(string $collection, array $doc)
    {
        return Http::withHeaders([
            'X-TYPESENSE-API-KEY' => $this->apiKey,
        ])->post($this->baseUrl . "/collections/$collection/documents", $doc)->json();
    }

    public function search(string $collection, array $params)
    {
        return Http::withHeaders([
            'X-TYPESENSE-API-KEY' => $this->apiKey,
        ])->get($this->baseUrl . "/collections/$collection/documents/search", $params)->json();
    }
}
