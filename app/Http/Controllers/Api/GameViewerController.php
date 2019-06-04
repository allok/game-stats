<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Games\GameViewerIndexRequest;
use App\Http\Resources\GameViewerCollection;
use App\Repositories\StreamRepository;

class GameViewerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GameViewerIndexRequest $request
     * @return GameViewerCollection
     */
    public function index(GameViewerIndexRequest $request)
    {
        return new GameViewerCollection(app(StreamRepository::class)->getViewersByFilters($request->validated(), [
            'game_id',
            'games.name as name',
        ]));
    }
}
