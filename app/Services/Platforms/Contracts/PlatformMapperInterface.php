<?php

namespace App\Services\Platforms\Contracts;

/**
 * Interface PlatformMapperInterface
 * @package App\Services\Platforms\Contracts
 * @property-read int $id
 * @property-read string $gameName
 * @property-read int $platformId
 * @property-read int $user_id
 * @property-read int $viewer_count
 * @property-read string $pagination
 */
interface PlatformMapperInterface
{
    public function __get(string $fieldName);
}
