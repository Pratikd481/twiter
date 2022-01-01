<?php

namespace App\Providers;

use App\Repositories\Eloquent\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( PostRepositoryInterface::class, PostRepository::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
