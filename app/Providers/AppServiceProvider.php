<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any Application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any Application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\IGenericoRepositorio', 'App\repositorios\GenericoRepositorio');
        $this->app->bind('App\Interfaces\IAlunoRepositorio', 'App\Repositorios\AlunoRepositorio');
        
        $this->app->bind('App\Interfaces\IClassificacaoRepositorio', 'App\Repositorios\ClassificacaoRepositorio');

        $this->app->bind('App\Interfaces\IDisciplinaRepositorio', 'App\Repositorios\DisciplinaRepositorio');

        $this->app->bind('App\Interfaces\IUtilizadorRepositorio', 'App\Repositorios\UtilizadorRepositorio');

        $this->app->bind('App\Interfaces\IUtilizadorRepositorio', 'App\Repositorios\UtilizadorRepositorio');
    }
}
