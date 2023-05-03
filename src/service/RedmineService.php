<?php

namespace App\service;

use GuzzleHttp\Client;

class RedmineService
{
    private $client;
    private $apiKey;

    public function __construct(string $url, string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(['base_uri' => $url]);
    }

    public function createProject(string $name, string $description, bool $isPublic): array
    {
        $response = $this->client->post('projects.json', [
            'headers' => [
                'X-Redmine-API-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'project' => [
                    'name' => $name,
                    'description' => $description,
                    'is_public' => $isPublic,
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true)['project'];
    }
}