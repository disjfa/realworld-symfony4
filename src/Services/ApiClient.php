<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ApiClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ApiClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://conduit.productionready.io/',
            'headers' => [
                'Content-type' => 'application/json',
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function send(Request $request): array
    {
        $response = $this->client->send($request);
        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return array
     */
    public function getArticles(array $query = []): array
    {
        $request = new Request('GET', '/api/articles?' . http_build_query($query));
        return $this->send($request);
    }

    public function getProfile(string $username): array
    {
        $request = new Request('GET', '/api/profiles/' . $username);
        return $this->send($request);
    }

    public function autheticate(array $user)
    {
        $request = new Request('POST', '/api/users/login', [], \GuzzleHttp\json_encode(['user' => $user]));
        return $this->send($request);
    }
}