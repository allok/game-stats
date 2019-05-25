<?php

namespace App\Models\Stream;

use App\Models\Game;
use App\Models\Platform\Platform;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Stream\Stream
 *
 * @property int $id
 * @property int $platform_id
 * @property int $external_id
 * @property int $user_id
 * @property int $game_id
 * @property string $started_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\Stream whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Game $game
 * @property-read Platform $platform
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stream\Stream[] $logs
 */
class Stream extends Model
{
    public $timestamps = false;

    public $fillable = [
        'platform_id',
        'external_id',
        'user_id',
        'game_id',
        'started_at',
    ];

    public $dates = [
        'started_at',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(StreamLog::class);
    }
}
