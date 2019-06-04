<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameCollection;
use App\Repositories\GameRepository;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return GameCollection
     */
    public function index()
    {
        return new GameCollection(app(GameRepository::class)->all(['id', 'name']));
    }
}
