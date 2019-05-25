<?php

namespace App\Models\Stream;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Stream\StreamLog
 *
 * @property int $id
 * @property int $stream_id
 * @property int $viewer_count
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\StreamLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\StreamLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\StreamLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\StreamLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\StreamLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\StreamLog whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stream\StreamLog whereViewerCount($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Stream\Stream $stream
 */
class StreamLog extends Model
{
    public $timestamps = false;

    public $fillable = [
        'viewer_count',
        'created_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }
}
