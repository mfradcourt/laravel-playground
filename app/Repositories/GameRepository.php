<?php

namespace App\Repositories;

use App\Models\Game;

interface GameRepository
{
    public function searchGames(string $searchText): array;
    public function findById(int $id): Game;
    public function getByIds(array $ids): array;
}
