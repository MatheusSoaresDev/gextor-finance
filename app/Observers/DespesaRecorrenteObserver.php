<?php

namespace App\Observers;

use App\Models\DespesaRecorrente;
use App\Models\Receita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class DespesaRecorrenteObserver
{
    /**
     * Handle the DespesaRecorrente "created" event.
     *
     * @param  \App\Models\DespesaRecorrente  $despesaRecorrente
     * @return void
     */
    public function created(DespesaRecorrente $despesaRecorrente)
    {

    }

    public function creating(DespesaRecorrente $despesaRecorrente)
    {
        $despesaRecorrente->data = ((new \DateTime(''))->setDate(Request::session()->get('data')['ano'], Request::session()->get('data')['mes'], '01'))->format("Y-m-d");
        $despesaRecorrente->id_user = Auth::id();
        $despesaRecorrente->valor = str_replace([','],['.'], $despesaRecorrente->valor);
    }

    public function saving(DespesaRecorrente $despesaRecorrente)
    {
        if(str_contains($despesaRecorrente->valor, ',')){
            $despesaRecorrente->valor = str_replace(['.',','],['','.'], $despesaRecorrente->valor);
        }
    }

    /**
     * Handle the DespesaRecorrente "updated" event.
     *
     * @param  \App\Models\DespesaRecorrente  $despesaRecorrente
     * @return void
     */
    public function updated(DespesaRecorrente $despesaRecorrente)
    {
        //
    }

    /**
     * Handle the DespesaRecorrente "deleted" event.
     *
     * @param  \App\Models\DespesaRecorrente  $despesaRecorrente
     * @return void
     */
    public function deleted(DespesaRecorrente $despesaRecorrente)
    {
        //
    }

    /**
     * Handle the DespesaRecorrente "restored" event.
     *
     * @param  \App\Models\DespesaRecorrente  $despesaRecorrente
     * @return void
     */
    public function restored(DespesaRecorrente $despesaRecorrente)
    {
        //
    }

    /**
     * Handle the DespesaRecorrente "force deleted" event.
     *
     * @param  \App\Models\DespesaRecorrente  $despesaRecorrente
     * @return void
     */
    public function forceDeleted(DespesaRecorrente $despesaRecorrente)
    {
        //
    }
}
