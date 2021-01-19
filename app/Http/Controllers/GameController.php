<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Repositories\GameRepository;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * The game repository instance.
     *
     * @var GameRepository
     */
    protected $gameRepository;

    /**
     * Create a new controller instance.
     *
     * @param GameRepository $gameRepository
     * @return void
     */
    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function index()
    {
        $gameIds = Games::all()->pluck('ext_id')->toArray();

        return view('games', [
            'games' => $this->gameRepository->getByIds($gameIds)
        ]);
    }

    public function delete(Request $request)
    {
        Games::query()->where('ext_id', $request->id)->delete();

        return redirect('/');
    }

    public function add(Request $request)
    {
        $gameId = $request->input('search');

        $games = new Games();
        $games->ext_id = $gameId;
        $games->save();

        return redirect('/');
    }

    public function search(Request $request)
    {
        if(!$request->has('q')) {
            return [];
        }

        $searchText = $request->q;

        return $this->gameRepository->searchGames($searchText);
    }
}
