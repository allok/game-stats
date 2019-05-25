<?php

namespace App\Models\Platform;

use App\Models\Scopes\ActiveScope;
use App\Models\Stream\Stream;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Platform
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stream\Stream[] $streams
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform\Platform active()
 */
class Platform extends Model
{
    use ActiveScope;

    const IS_ACTIVE_FIELD = 'is_active';

    public $timestamps = false;

    public $casts = [
        self::IS_ACTIVE_FIELD => 'bool',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function streams()
    {
        return $this->hasMany(Stream::class);
    }
}
