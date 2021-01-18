<?php

use App\Models\Game;
use App\Repositories\GameAPIRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $games = Game::orderBy('name', 'asc')->get();

    return view('games', [
        'games' => $games
    ]);
});

Route::get('/search', function (Request $request) {
    if($request->has('q')) {
        $searchText = $request->q;
        $gameRepository = new GameAPIRepository();

        return $gameRepository->searchGames($searchText);
    }
});

Route::post('/game', function (Request $request) {
    $gameId = $request->input('search');

    $gameRepository = new GameAPIRepository();
    $gameData = $gameRepository->getGame($gameId);

    $game = new Game($gameData);
    $game->save();

    return redirect('/');
});

Route::delete('/game/{game}', function (Game $game) {
    $game->delete();

    return redirect('/');
});
