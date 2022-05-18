<?php

namespace App\Repositories\Eloquent;

use App\Models\DespesaRecorrente;
use App\Models\Mes_Despesa_Recorrente;
use App\Repositories\Contracts\MesDespesaRecorrenteRepositoryInterface;

class MesDespesaRecorrenteRepository extends AbstractRepository implements MesDespesaRecorrenteRepositoryInterface
{
    protected $model = Mes_Despesa_Recorrente::class;

    public function getDespesaPorMes()
    {
        return DespesaRecorrente::with(['mes_despesa_recorrente'])->get();
    }
}
