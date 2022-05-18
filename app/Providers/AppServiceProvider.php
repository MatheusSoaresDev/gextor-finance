<?php

namespace App\Providers;

use App\Models\DespesaRecorrente;
use App\Observers\DespesaRecorrenteObserver;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DespesaRecorrente::observe(DespesaRecorrenteObserver::class);
    }
}
