<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use App\Models\Stream\Stream;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property int $external_id
 * @property string $name
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stream\Stream[] $streams
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game active()
 */
class Game extends Model
{
    use ActiveScope;

    const IS_ACTIVE_FIELD = 'is_active';

    public $timestamps = false;

    public $fillable = [
        'name',
    ];

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
