<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Arquivos\ArquivoReceita;
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

    public function getFile(string $idArquivo)
    {
        $file = ArquivoReceita::where('id', $idArquivo)->first();
        $path = storage_path("app/arquivos/$file->id".'.'.$file->extensao);

        return response()->file($path, [
            'Content-Type' => $file->tipo,
            'Cache-Control' => 'no-cache',
            'Pragma' => 'no-cache',
            'Content-Disposition', 'inline;filename=myfile.pdf',
        ]);
    }
}
