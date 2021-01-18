<?php

namespace App\Repositories;

use App\Http\Resources\Game;
use Illuminate\Support\Facades\Http;

class GameAPIRepository {

    protected $apiUrl = 'https://api.rawg.io/api';

    public function searchGames($searchText)
    {
        $response = Http::get($this->apiUrl . '/games', [
            'search' => $searchText,
            'ordering' => 'name',
            'search_precise' => true,
            'search_exact'=> true
        ]);

        $results = $response->json();

        return Game::collection($results['results'])->resolve();
    }

    public function getGame($id)
    {
        $response = Http::get($this->apiUrl . '/games/' . $id);
        $gameData = $response->json();

        return Game::make($gameData)->resolve();
    }
}
