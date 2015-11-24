<?php

namespace Codeproject\Providers;

use Illuminate\Support\ServiceProvider;

class CodeProjectRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            \Codeproject\Repositories\ClientRepository::class,
            \Codeproject\Repositories\ClientRepositoryEloquent::class
        );

        $this->app->bind(
          \Codeproject\Repositories\ProjectRepository::class,
          \Codeproject\Repositories\ProjectRepositoryEloquent::class
        );

        $this->app->bind(
          \Codeproject\Repositories\ProjectNoteRepository::class,
          \Codeproject\Repositories\ProjectNoteRepositoryEloquent::class
        );
    }
}
