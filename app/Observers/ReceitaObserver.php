<?php

namespace App\Observers;

use App\Models\Receita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ReceitaObserver
{
    /**
     * Handle the Receita "created" event.
     *
     * @param  \App\Models\Receita  $receita
     * @return void
     */
    public function created(Receita $receita)
    {
        //
    }

    public function creating(Receita $receita)
    {
        $receita->data = ((new \DateTime(''))->setDate(Request::session()->get('data')['ano'], Request::session()->get('data')['mes'], '01'))->format("Y-m-d");
        $receita->id_user = Auth::id();
        $receita->valor = str_replace([','],['.'], $receita->valor);
    }

    /*public function updating(Receita $receita)
    {
        $receita->valor = str_replace(['.',','],['','.'], $receita->valor);
    }*/

    public function saving(Receita $receita)
    {
        if(str_contains($receita->valor, ',')){
            $receita->valor = str_replace(['.',','],['','.'], $receita->valor);
        }
    }

    public function deleting(Receita $receita){
        $arquivos = $receita->arquivos()->get();

        foreach ($arquivos as $arq){
            Storage::delete($arq->id . '.' . $arq->extensao);
            $arq->delete();
        }
    }

    /**
     * Handle the Receita "deleted" event.
     *
     * @param  \App\Models\Receita  $receita
     * @return void
     */
    public function deleted(Receita $receita)
    {

    }

    /**
     * Handle the Receita "restored" event.
     *
     * @param  \App\Models\Receita  $receita
     * @return void
     */
    public function restored(Receita $receita)
    {
        //
    }

    /**
     * Handle the Receita "force deleted" event.
     *
     * @param  \App\Models\Receita  $receita
     * @return void
     */
    public function forceDeleted(Receita $receita)
    {
        //
    }
}
