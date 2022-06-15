<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ReceitaRepositoryInterface;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    private ReceitaRepositoryInterface $receitaRepository;

    public function __construct(ReceitaRepositoryInterface $receitaRepository)
    {
        $this->receitaRepository = $receitaRepository;
    }

    public function create(Request $request)
    {
        $despesa = $this->receitaRepository->create($request->all());
        return self::redirect($despesa, "cadastrar", "home");
    }
}
