<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DespesaParceladaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DespesaParceladaController extends Controller
{
    private DespesaParceladaRepositoryInterface $despesaParceladaRepository;

    public function __construct(DespesaParceladaRepositoryInterface $despesaParceladaRepository)
    {
        $this->despesaParceladaRepository = $despesaParceladaRepository;
    }

    public function create(Request $request)
    {
        $data = $request->only(['nome', 'valor_total', 'data', 'forma_pagamento', 'qtd_parcelas', 'comentario']);
        $despesa = $this->despesaParceladaRepository->create($data);

        return self::redirect($despesa, "cadastrar", "home");
    }
}
