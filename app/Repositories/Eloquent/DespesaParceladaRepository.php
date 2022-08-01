<?php

namespace App\Repositories\Eloquent;

use App\Models\DespesaParcelada;
use App\Models\Parcela;
use App\Repositories\Contracts\DespesaParceladaRepositoryInterface;
use Illuminate\Support\Facades\Request;

class DespesaParceladaRepository extends AbstractRepository implements DespesaParceladaRepositoryInterface
{
    protected $model = DespesaParcelada::class;
    protected Parcela $parcelas;

    public function __construct(Parcela $parcelas)
    {
        $this->parcelas = $parcelas;
        parent::__construct();
    }

    public function getParcelasMes()
    {
        $despesas = $this->all()->with(["parcelas" => function($parcela){
            $parcela->whereMonth('data', Request::session()->get('data')['mes'])
                    ->whereYear('data', Request::session()->get('data')['ano'])
                ->first();
        }])->get();

        return $despesas;
    }
}
