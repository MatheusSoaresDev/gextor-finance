<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDespesaFixaRequest;
use App\Http\Requests\UpdateDespesaRecorrenteRequest;
use App\Models\ArquivoDespesaRecorrente;
use App\Models\DespesaRecorrente;
use App\Repositories\Contracts\DespesaRecorrenteRepositoryInterface;
use Illuminate\Http\Request;

class DespesaRecorrenteController extends Controller
{
    private DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository;

    public function __construct(DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository)
    {
        $this->despesaRecorrenteRepository = $despesaRecorrenteRepository;
    }

    public function create(CreateDespesaFixaRequest $request)
    {
        $despesa = $this->despesaRecorrenteRepository->create($request->all());
        return self::redirect($despesa, "cadastrar", "home");
    }

    public function update(UpdateDespesaRecorrenteRequest $request)
    {
        $data = $request->only(['id', 'nome', 'valor', 'forma_pagamento', 'status', 'data', 'comentário']);
        $files = $request->only(['id', 'boleto', 'comprovante']);

        $despesa = $this->despesaRecorrenteRepository->update($data);
        $this->despesaRecorrenteRepository->anexarArquivos($files);

        return self::redirect($despesa, "atualizar", "home");
    }

    public function delete(string $id)
    {
        $despesa = $this->despesaRecorrenteRepository->delete($id);
        return self::redirect($despesa, "excluir", "home");
    }

    public function getFile(string $idArquivo)
    {
        $file = ArquivoDespesaRecorrente::where('id', $idArquivo)->first();
        $path = storage_path("app/arquivos/$file->id".'.'.$file->extensao);

        return response()->file($path, [
            'Content-Type' => $file->tipo,
            'Cache-Control' => 'no-cache',
            'Pragma' => 'no-cache',
            'Content-Disposition', 'inline;filename=myfile.pdf',
        ]);
    }
}
