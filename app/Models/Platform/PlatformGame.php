<?php

namespace App\Models\Platform;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Platform\PlatformGame
 *
 * @property int $game_id
 * @property int $platform_id
 * @property int $external_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform\PlatformGame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform\PlatformGame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform\PlatformGame query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform\PlatformGame whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform\PlatformGame whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Platform\PlatformGame wherePlatformId($value)
 * @mixin \Eloquent
 */
class PlatformGame extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    public $fillable = [
        'game_id',
        'platform_id',
        'external_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
