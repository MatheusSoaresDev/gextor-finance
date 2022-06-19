<?php

namespace App\Repositories\Exceptions;

use App\Models\Arquivos\ArquivoReceita;
use App\Models\Receita;
use App\Repositories\Contracts\Arquivos\ReceitaArquivoRepositoryInterface;
use App\Repositories\Rules\Arquivo;

class ArquivoReceitaExceptions extends Exceptions
{
    protected $model = Receita::class;
    protected string $tipo = 'receita';
}
