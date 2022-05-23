<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDespesaFixaRequest;
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
        $data = $request->only(['id', 'nome', 'valor', 'forma_pagamento', 'status', 'data', 'comentário']);
        $despesa = $this->despesaRecorrenteRepository->update($data);

        return self::redirect($despesa, "atualizar", "home");
    }

    public function delete(string $id)
    {
        $despesa = $this->despesaRecorrenteRepository->delete($id);
        return self::redirect($despesa, "excluir", "home");
    }

    private static function redirect($response, string $action, string $redirectPage)
    {
        if($response){
            return redirect($redirectPage)->withSuccess("Despesa {$action} com sucesso!");
        }
        return redirect($redirectPage)->withErrors("Não foi {$action} a despesa!");
    }
}
