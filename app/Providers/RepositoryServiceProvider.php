<?php

namespace App\Providers;

use App\Repositories\FavoriteRepository;
use App\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bind the interface to an implementation repository class
     */
    public function register()
    {
        $this->app->bind(
            FavoriteRepositoryInterface::class,
            FavoriteRepository::class
        );
    }
}