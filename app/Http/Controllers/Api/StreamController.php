<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Streams\StreamIndexRequest;
use App\Http\Resources\StreamCollection;
use App\Repositories\StreamRepository;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param StreamIndexRequest $request
     * @return StreamCollection
     */
    public function index(StreamIndexRequest $request)
    {
        return new StreamCollection(app(StreamRepository::class)->getByFilters($request->validated(), [
            'streams.id',
            'streams.platform_id',
            'streams.user_id',
            'streams.game_id',
            'games.name as game_name',
        ]));
    }
}
