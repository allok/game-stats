<?php

namespace App\Services\Platforms\Factory;

use App\Services\Platforms\Contracts\PlatformApiInterface;
use App\Services\Platforms\Twitch\Api\TwitchApi;

/**
 * Class PlatformFactory
 * @package App\Services\Platforms\Factory
 */
final class PlatformFactory
{
    /**
     * @param int $platformId
     * @return PlatformApiInterface
     */
    public static function factory(int $platformId): PlatformApiInterface
    {
        switch ($platformId) {
            case PlatformApiInterface::TWITCH_ID:
                return new TwitchApi;
            default:
                throw new \InvalidArgumentException('Wrong platform id');
        }
    }
}
