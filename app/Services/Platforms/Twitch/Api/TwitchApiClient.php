<?php

namespace App\Services\Platforms\Twitch\Api;

use NewTwitchApi\NewTwitchApi;

final class TwitchApiClient extends NewTwitchApi
{
    /**
     * @var TwitchTopGamesApi
     */
    private $gamesTopApi;

    /**
     * TwitchApiClient constructor.
     */
    public function __construct()
    {
        parent::__construct($guzzleClient = new TwitchApiHelixClient, '', '');

        $this->gamesTopApi = new TwitchTopGamesApi($guzzleClient);
    }

    /**
     * @return TwitchTopGamesApi
     */
    public function getGamesTopApi(): TwitchTopGamesApi
    {
        return $this->gamesTopApi;
    }
}
