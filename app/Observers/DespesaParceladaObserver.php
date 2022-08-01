<?php

namespace App\Observers;

use App\Models\DespesaParcelada;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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
        for($i=0; $i<$despesaParcelada->qtd_parcelas; $i++){
            $despesaParcelada->parcelas()->create([
                "parcela" => $i+1,
                "data" => self::insertData($despesaParcelada->data, $i),
                "valor" => $despesaParcelada->valor_total / $despesaParcelada->qtd_parcelas,
            ]);
        }
    }

    private static function insertData(string $dataInformada, int $indice)
    {
        $date = new DateTime($dataInformada);
        $date->add(new DateInterval("P${indice}M"));

        return $date;
    }

    public function creating(DespesaParcelada $despesaParcelada)
    {
        $despesaParcelada->id_user = Auth::id();
        $despesaParcelada->valor_total = str_replace([','],['.'], $despesaParcelada->valor_total);
    }

    public function saving(DespesaParcelada $despesaParcelada)
    {
        if(str_contains($despesaParcelada->valor_total, ',')){
            $despesaParcelada->valor_total = str_replace(['.',','],['','.'], $despesaParcelada->valor_total);
        }
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
