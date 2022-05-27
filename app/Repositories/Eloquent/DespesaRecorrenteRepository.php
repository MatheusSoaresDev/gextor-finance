<?php

namespace App\Repositories\Eloquent;

use App\Models\DespesaRecorrente;
use App\Models\Mes_Despesa_Recorrente;
use App\Repositories\Contracts\DespesaRecorrenteRepositoryInterface;
use App\Repositories\Rules\Arquivo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class DespesaRecorrenteRepository extends AbstractRepository implements DespesaRecorrenteRepositoryInterface
{
    protected $model = DespesaRecorrente::class;

    public function getDespesaPorMes()
    {
        return $this->all()
            ->whereMonth('data', Request::session()->get('data')['mes'])
            ->whereYear('data', Request::session()->get('data')['ano'])
            ->get();
    }

    public function anexarArquivos(array $data):void
    {
        $despesa = $this->get($data["id"]);

        if(isset($data["boleto"])){Arquivo::create($despesa, $data, 'boleto');}
        if(isset($data["comprovante"])){Arquivo::create($despesa, $data, 'comprovante');}
    }
}
