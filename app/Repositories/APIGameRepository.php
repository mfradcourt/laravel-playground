<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Support\Facades\Http;

class APIGameRepository implements GameRepository
{
    private $apiUrl = 'https://api.rawg.io/api';
    private $apiKey = '';

    public function searchGames(string $searchText): array
    {
        $results = Http::get($this->apiUrl . '/games', [
            'key' => $this->apiKey,
            'search' => $searchText,
            'ordering' => 'name',
            'search_precise' => true,
            'search_exact'=> true
        ])->json();

        return array_map(function ($arr) {
            return new Game($arr['id'], $arr['name'], $arr['released']);
        }, $results['results']);
    }

    public function getByIds(array $ids): array
    {
        $games = [];
        foreach ($ids as $id) {
            $games[] = $this->findById((int)$id);
        }

        return $games;
    }

    public function findById(int $id): Game
    {
        $result = Http::get($this->apiUrl . '/games/' . $id, [
            'key' => $this->apiKey,
        ])->json();

        return new Game($result['id'], $result['name'], $result['released']);
    }
}
