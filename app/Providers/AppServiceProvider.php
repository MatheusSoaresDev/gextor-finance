<?php

namespace App\Providers;

use App\Models\DespesaRecorrente;
use App\Models\Receita;
use App\Observers\DespesaRecorrenteObserver;
use App\Observers\ReceitaObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\DespesaRecorrenteRepositoryInterface',
            'App\Repositories\Eloquent\DespesaRecorrenteRepository',
        );

        $this->app->bind(
            'App\Repositories\Contracts\ReceitaRepositoryInterface',
            'App\Repositories\Eloquent\ReceitaRepository',
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DespesaRecorrente::observe(DespesaRecorrenteObserver::class);
        Receita::observe(ReceitaObserver::class);

        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);
    }
}
