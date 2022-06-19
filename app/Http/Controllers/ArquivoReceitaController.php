<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Receita;
use App\Repositories\Contracts\Arquivos\ReceitaArquivoRepositoryInterface;
use App\Repositories\Exceptions\ArquivoReceitaExceptions;
use Illuminate\Http\Request;

class ArquivoReceitaController extends Controller
{
    private ArquivoReceitaExceptions $arquivoReceitaExceptions;

    public function __construct(ArquivoReceitaExceptions $arquivoReceitaExceptions)
    {
        $this->arquivoReceitaExceptions = $arquivoReceitaExceptions;
    }

    public function create(Request $request)
    {
        $data = $request->only(['id','tipo', 'file']);
        return $this->arquivoReceitaExceptions->create($data);
    }
}
