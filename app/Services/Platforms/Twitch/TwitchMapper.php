<?php

namespace App\Services\Platforms\Twitch;

use App\Services\Platforms\Contract\PlatformMapperInterface;
use App\Services\Platforms\Twitch\Api\TwitchApi;

class TwitchMapper implements PlatformMapperInterface
{
    private $mapper = [
        'id' => 'id',
        'gameName' => 'name',
        'platformId' => TwitchApi::ID,
        'pagination' => 'pagination.cursor',
    ];

    function __get(string $fieldName)
    {
        if (method_exists($this, $fieldName)) {
            return $fieldName();
        }

        return $this->mapper{$fieldName} ?? $fieldName;
    }
}
