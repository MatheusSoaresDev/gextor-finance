<?php

namespace App\Repositories\Eloquent;

use App\Models\DespesaParcelada;
use App\Repositories\Contracts\DespesaParceladaRepositoryInterface;
use Illuminate\Support\Facades\Request;

class DespesaParceladaRepository extends AbstractRepository implements DespesaParceladaRepositoryInterface
{
    protected $model = DespesaParcelada::class;

    public function getDespesaPorMes()
    {
        return $this->all()
            ->whereMonth('data', Request::session()->get('data')['mes'])
            ->whereYear('data', Request::session()->get('data')['ano'])
            ->get();
    }
}
