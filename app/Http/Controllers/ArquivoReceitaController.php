<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Arquivos\ArquivoReceita;
use App\Models\Receita;
use App\Repositories\Contracts\Arquivos\ReceitaArquivoRepositoryInterface;
use App\Repositories\Exceptions\ArquivoReceitaExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function get(string $id)
    {
        return $this->arquivoReceitaExceptions->get($id);
    }

    public function update(Request $request)
    {
        $data = $request->only(['id_obj', 'id_file', 'tipo']);
        return $this->arquivoReceitaExceptions->update($data);
    }

    public function delete(Request $request)
    {
        $data = $request->only(['id_obj', 'id_file', 'tipo']);
        return $this->arquivoReceitaExceptions->delete($data);
    }

    public function viewFile(string $idArquivo)
    {
        $file = ArquivoReceita::where('id', $idArquivo)->first();
        return Storage::response($file->id.'.'.$file->extensao);
    }

    public function downloadFile(string $idArquivo)
    {
        $file = ArquivoReceita::where('id', $idArquivo)->first();
        return Storage::download($file->id.'.'.$file->extensao);
    }
}


