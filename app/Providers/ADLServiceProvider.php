<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ADLServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Bindando a classe User como singleton
         * Para facilitar implementações futuras, e para não precisar instanciá-la
         * Toda vez que eu for usá-la em algum método, por exemplo no repositório.
         */

        # Repositório de usuários
        $this->app->bind(
            'App\RDias\Domain\Repositories\Contracts\UserRepositoryInterface',
            'App\RDias\Domain\Repositories\UserRepository'
        );
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
