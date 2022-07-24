<?php

namespace App\Repositories\Eloquent;

use App\Models\DespesaParcelada;
use App\Repositories\Contracts\DespesaParceladaRepositoryInterface;
use App\Repositories\Contracts\ParcelasRepositoryInterface;

class DespesaParceladaRepository extends AbstractRepository implements DespesaParceladaRepositoryInterface
{
    protected $model = DespesaParcelada::class;

    public function getParcelasMes()
    {
        $despesas = $this->all()->get();

        //foreach ()
    }
}
