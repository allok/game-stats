<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Platform\Platform;
use Illuminate\Database\Eloquent\Collection;

class PlatformRepository
{
    /**
     * @param array $columns
     * @return Collection|Platform[]
     */
    public function all(array $columns = ['*']): Collection
    {
        return Platform::active()->get($columns);
    }
}
