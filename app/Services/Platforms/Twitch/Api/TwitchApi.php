<?php

namespace App\Services\Platforms\Twitch\Api;

use App\Services\Platforms\Contracts\PlatformApiInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class TwitchApi implements PlatformApiInterface
{
    const ID = PlatformApiInterface::TWITCH_ID;

    private static $first = 100;

    /**
     * @var TwitchApiClient
     */
    private $client;

    public function __construct()
    {
        $this->client = new TwitchApiClient();
    }

    /**
     * @param string|null $after
     * @return array
     * @throws \Exception
     */
    public function getTopGames(?string $after = null): array
    {
        return $this->request(function () use ($after) {
            return $this->client->getGamesTopApi()->getTopGames(self::$first, $after);
        });
    }

    /**
     * @param array $gameIds
     * @param string|null $after
     * @return array
     * @throws \Exception
     */
    public function getStreams(array $gameIds, ?string $after): array
    {
        return $this->request(function () use ($gameIds, $after) {
            return $this->client->getStreamsApi()->getStreams([], [], $gameIds, [], [], self::$first, null, $after);
        });
    }

    /**
     * @param callable $callable
     * @return mixed
     * @throws ApiException
     */
    private function request(callable $callable)
    {
        try {
            $response = $this->callRequest($callable);
            $this->handleRateLimit($response);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param ResponseInterface $response
     */
    private function handleRateLimit(ResponseInterface $response)
    {
        // TODO implement
        // $response->getHeaderLine('Ratelimit-Reset') - time();
        // $response->getHeaderLine('Ratelimit-Remaining');
    }

    /**
     * @param callable $callable
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function callRequest(callable $callable): ResponseInterface
    {
        return $callable();
    }
}
