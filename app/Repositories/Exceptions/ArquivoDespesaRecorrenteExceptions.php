<?php

namespace App\Repositories\Exceptions;

use App\Models\DespesaRecorrente;

class ArquivoDespesaRecorrenteExceptions extends Exceptions
{
    protected $model = DespesaRecorrente::class;
    protected string $tipo = 'despesaRecorrente';
}
