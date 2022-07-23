<?php

namespace App\Http\Controllers;

use App\Models\Arquivos\ArquivoDespesaRecorrente;
use App\Models\Arquivos\ArquivoReceita;
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

    public function update(Request $request)
    {
        $data = $request->only(['id_obj', 'id_file', 'tipo']);
        return $this->arquivoDespesaRecorrenteExceptions->update($data);
    }

    public function delete(Request $request)
    {
        $data = $request->only(['id_obj', 'id_file', 'tipo']);
        return $this->arquivoDespesaRecorrenteExceptions->delete($data);
    }

    public function viewFile(string $idArquivo)
    {
        return $this->arquivoDespesaRecorrenteExceptions->viewFile($idArquivo, ArquivoDespesaRecorrente::class);
    }

    public function downloadFile(string $idArquivo)
    {
        return $this->arquivoDespesaRecorrenteExceptions->downloadFile($idArquivo, ArquivoDespesaRecorrente::class);
    }
}
