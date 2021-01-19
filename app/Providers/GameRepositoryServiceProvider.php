<?php


namespace App\Providers;

use App\Repositories\APIGameRepository;
use App\Repositories\GameRepository;
use Illuminate\Support\ServiceProvider;

class GameRepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GameRepository::class, APIGameRepository::class);
    }
}
