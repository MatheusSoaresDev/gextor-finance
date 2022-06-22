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

    public function get(string $idArquivo)
    {
        $file = ArquivoReceita::where('id', $idArquivo)->first();
        return Storage::response($file->id.'.'.$file->extensao);
    }

    public function list(string $id)
    {
        return $this->arquivoReceitaExceptions->list($id);

    }

    public function alteraTipo(Request $request)
    {
        $data = $request->only(['id_obj', 'id_file', 'tipo']);
        return $this->arquivoReceitaExceptions->alteraTipo($data);
    }
}


