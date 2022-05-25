<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDespesaFixaRequest;
use App\Models\Arquivo;
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

    public function update(Request $request)
    {
        $data = $request->only(['id', 'nome', 'valor', 'forma_pagamento', 'status', 'data', 'comentário', 'boleto', 'comprovante']);
        $despesa = $this->despesaRecorrenteRepository->update($data);

        $this->despesaRecorrenteRepository->anexarArquivos($data);

        return self::redirect($despesa, "atualizar", "home");
    }

    public function delete(string $id)
    {
        $despesa = $this->despesaRecorrenteRepository->delete($id);
        return self::redirect($despesa, "excluir", "home");
    }

    public function openFile(string $idArquivo)
    {
        $file = Arquivo::find($idArquivo)->first();
        $path = storage_path("app/arquivos/$file->id".'.'.$file->extensao);

        return response()->file($path, [
            'Content-Type' => $file->tipo,
            'Cache-Control' => 'no-cache',
            'Pragma' => 'no-cache',
            'Content-Disposition', 'inline;filename=myfile.pdf',
        ]);
    }

    private static function redirect($response, string $action, string $redirectPage)
    {
        if($response){
            return redirect($redirectPage)->withSuccess("Despesa {$action} com sucesso!");
        }
        return redirect($redirectPage)->withErrors("Não foi {$action} a despesa!");
    }
}
