<?php

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        $response = Http::get('https://api.rawg.io/api/games', [
            'search' => $searchText,
            'ordering' => 'name',
            'search_precise' => true,
            'search_exact'=> true
        ]);

        //@TODO check if the response contains results

        $results = $response->json();
        $games = array_map(function($game) {
            return [
                'id' => $game['id'],
                'name' => $game['name']
            ];
        }, $results['results']);

        return $games;
    }
});

Route::post('/game', function (Request $request) {

    $gameId = $request->input('search');

    $response = Http::get('https://api.rawg.io/api/games/' . $gameId);
    $gameData = $response->json();

    $game = new Game();
    $game->name = $gameData['name'];
    $game->released_at = $gameData['released'];
    $game->save();

    return redirect('/');
});

Route::delete('/game/{game}', function (Game $game) {
    $game->delete();

    return redirect('/');
});
