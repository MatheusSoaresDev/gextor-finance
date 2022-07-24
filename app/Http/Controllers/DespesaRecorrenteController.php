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
        $data = $request->only(['id', 'nome', 'valor', 'forma_pagamento', 'status', 'data', 'comentário']);
        $despesa = $this->despesaRecorrenteRepository->create($data);

        return self::redirect($despesa, "cadastrar", "home");
    }

    public function update(UpdateDespesaRecorrenteRequest $request)
    {
        $data = $request->only(['id', 'nome', 'valor', 'forma_pagamento', 'status', 'data', 'comentário']);
        $despesa = $this->despesaRecorrenteRepository->update($data);

        return self::redirect($data, "atualizar", "home");
    }

    public function delete(string $id)
    {
        $despesa = $this->despesaRecorrenteRepository->delete($id);
        return self::redirect($despesa, "excluir", "home");
    }
}
