<?php

namespace App\Services\Platforms\Twitch\Api;

use App\Services\Platforms\Contract\PlatformApiInterface;
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
     * @throws \Exception
     */
    private function request(callable $callable)
    {
        try {
            /** @var ResponseInterface $response */
            $response = $callable();

            $reset = $response->getHeaderLine('Ratelimit-Reset') - time();
            echo 'Remaining:' . $response->getHeaderLine('Ratelimit-Remaining') . "reset in $reset \n";

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            //report($e);
            //dump($e->getMessage());

            throw new \Exception($e->getMessage() . 'reset in ' . ($reset ?? 'no'));
        }
    }
}
