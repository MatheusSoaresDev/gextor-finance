<?php

namespace App\Observers;

use App\Models\DespesaParcelada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class DespesaParceladaObserver
{
    /**
     * Handle the DespesaParcelada "created" event.
     *
     * @param  \App\Models\DespesaParcelada  $despesaParcelada
     * @return void
     */
    public function created(DespesaParcelada $despesaParcelada)
    {
        //
    }

    public function creating(DespesaParcelada $despesaParcelada)
    {
        $despesaParcelada->data = ((new \DateTime(''))->setDate(Request::session()->get('data')['ano'], Request::session()->get('data')['mes'], '01'))->format("Y-m-d");
        $despesaParcelada->id_user = Auth::id();
        $despesaParcelada->valor_total = str_replace([','],['.'], $despesaParcelada->valor_total);
    }

    /**
     * Handle the DespesaParcelada "updated" event.
     *
     * @param  \App\Models\DespesaParcelada  $despesaParcelada
     * @return void
     */
    public function updated(DespesaParcelada $despesaParcelada)
    {
        //
    }

    /**
     * Handle the DespesaParcelada "deleted" event.
     *
     * @param  \App\Models\DespesaParcelada  $despesaParcelada
     * @return void
     */
    public function deleted(DespesaParcelada $despesaParcelada)
    {
        //
    }

    /**
     * Handle the DespesaParcelada "restored" event.
     *
     * @param  \App\Models\DespesaParcelada  $despesaParcelada
     * @return void
     */
    public function restored(DespesaParcelada $despesaParcelada)
    {
        //
    }

    /**
     * Handle the DespesaParcelada "force deleted" event.
     *
     * @param  \App\Models\DespesaParcelada  $despesaParcelada
     * @return void
     */
    public function forceDeleted(DespesaParcelada $despesaParcelada)
    {
        //
    }
}
