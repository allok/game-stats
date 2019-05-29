<?php

declare(strict_types=1);

namespace App\Services\Platforms\Twitch\Api;

use GuzzleHttp\Exception\GuzzleException;
use NewTwitchApi\Resources\AbstractResource;
use Psr\Http\Message\ResponseInterface;

final class TwitchTopGamesApi extends AbstractResource
{
    /**
     * @param int|null $first
     * @param string|null $after
     * @return ResponseInterface
     * @throws GuzzleException
     * @link https://dev.twitch.tv/docs/api/reference/#get-top-games
     */
    public function getTopGames(int $first = null, string $after = null): ResponseInterface
    {
        $queryParamsMap = [];

        if ($first) {
            $queryParamsMap[] = ['key' => 'first', 'value' => $first];
        }

        if ($after) {
            $queryParamsMap[] = ['key' => 'after', 'value' => $after];
        }

        return $this->callApi('games/top', $queryParamsMap);
    }
}
