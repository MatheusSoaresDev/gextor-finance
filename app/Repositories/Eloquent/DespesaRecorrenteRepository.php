<?php

namespace App\Repositories\Eloquent;

use App\Models\DespesaRecorrente;
use App\Repositories\Contracts\DespesaRecorrenteRepositoryInterface;
use Illuminate\Support\Facades\Request;

class DespesaRecorrenteRepository extends AbstractRepository implements DespesaRecorrenteRepositoryInterface
{
    protected $model = DespesaRecorrente::class;
}
