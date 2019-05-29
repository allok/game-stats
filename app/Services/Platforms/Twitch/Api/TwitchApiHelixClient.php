<?php

namespace App\Services\Platforms\Twitch\Api;

use GuzzleHttp\Exception\GuzzleException;
use NewTwitchApi\Auth\OauthApi;
use NewTwitchApi\HelixGuzzleClient;
use Psr\Http\Message\RequestInterface;

/**
 * Class TwitchApiHelixClient
 * @package App\Services\Platforms\Twitch\Api
 */
final class TwitchApiHelixClient extends HelixGuzzleClient
{
    /**
     * @var OauthApi
     */
    private $oauthClient;

    /**
     * @var string
     */
    private static $token;

    /**
     * TwitchApiClient constructor.
     */
    public function __construct()
    {
        $clientId = config('services.twitch.client_id');
        $clientSecret = config('services.twitch.client_secret');

        $this->oauthClient = new OauthApi($clientId, $clientSecret);

        if (!isset(self::$token)) {
            $this->setToken();
        }

        parent::__construct($clientId);
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(RequestInterface $request, array $options = [])
    {
        $options['headers']['Authorization'] = sprintf('Bearer %s', self::$token);

        return parent::send($request, $options);
    }

    private function setToken()
    {
        try {
            $response = $this->oauthClient->getAppAccessToken('')->getBody()->getContents();

            self::$token = json_decode($response, true)['access_token'];
        } catch (GuzzleException $e) {
            // Handle error
        }
    }
}
