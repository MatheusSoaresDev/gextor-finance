<?php

namespace App\Http\Controllers;

use App\Repositories\Exceptions\ArquivoDespesaRecorrenteExceptions;
use Illuminate\Http\Request;

class ArquivoDespesaRecorrenteController extends Controller
{
    private ArquivoDespesaRecorrenteExceptions $arquivoDespesaRecorrenteExceptions;

    public function __construct(ArquivoDespesaRecorrenteExceptions $arquivoDespesaRecorrenteExceptions)
    {
        $this->arquivoDespesaRecorrenteExceptions = $arquivoDespesaRecorrenteExceptions;
    }

    public function create(Request $request)
    {
        $data = $request->only(['id','tipo', 'file']);
        return $this->arquivoDespesaRecorrenteExceptions->create($data);
    }

    public function get(string $id)
    {
        return $this->arquivoDespesaRecorrenteExceptions->get($id);
    }
}
