<?php

namespace App\Services\Platforms\Factory;

use App\Services\Platforms\Contracts\PlatformApiInterface;
use App\Services\Platforms\Contracts\PlatformMapperInterface;
use App\Services\Platforms\Twitch\TwitchMapper;

/**
 * Class PlatformFactory
 * @package App\Services\Platforms\Factory
 */
final class MapperFactory
{
    /**
     * @param int $platformId
     * @return PlatformMapperInterface
     */
    public static function factory(int $platformId): PlatformMapperInterface
    {
        switch ($platformId) {
            case PlatformApiInterface::TWITCH_ID:
                return new TwitchMapper;
            default:
                throw new \InvalidArgumentException('Wrong platform id');
        }
    }
}
