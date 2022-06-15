<?php

namespace App\Repositories\Eloquent;

use App\Models\Receita;
use App\Repositories\Contracts\ReceitaRepositoryInterface;
use Illuminate\Support\Facades\Request;

class ReceitaRepository extends AbstractRepository implements ReceitaRepositoryInterface
{
    protected $model = Receita::class;

    public function getReceitaPorMes()
    {
        return $this->all()
            ->whereMonth('data', Request::session()->get('data')['mes'])
            ->whereYear('data', Request::session()->get('data')['ano'])
            ->get();
    }
}
