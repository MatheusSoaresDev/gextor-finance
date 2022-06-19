<?php

namespace App\Http\Controllers\Arquivos;

use App\Http\Controllers\Controller;
use App\Repositories\Exceptions\ArquivoReceitaExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArquivoController extends Controller
{
    private ArquivoReceitaExceptions $arquivoExceptions;

    public function __construct(ArquivoReceitaExceptions $arquivoExceptions)
    {
        $this->arquivoExceptions = $arquivoExceptions;
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'tipo', 'file']);
        $createdFile = $this->arquivoExceptions->create($data);

        return response()->json($createdFile);
    }
}
