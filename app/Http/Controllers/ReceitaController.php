<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReceitaRequest;
use App\Http\Requests\UpdateReceitaRequest;
use App\Models\Receita;
use App\Repositories\Contracts\ReceitaRepositoryInterface;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    private ReceitaRepositoryInterface $receitaRepository;

    public function __construct(ReceitaRepositoryInterface $receitaRepository)
    {
        $this->receitaRepository = $receitaRepository;
    }

    public function create(CreateReceitaRequest $request)
    {
        $data = $request->only(['nome', 'valor', 'comentario']);
        $receita = $this->receitaRepository->create($data);
        return self::redirect($receita, "cadastrar", "home");
        //
    }

    public function update(UpdateReceitaRequest $request)
    {
        $data = $request->only(['id', 'nome', 'data', 'valor', 'status', 'comentario']);
        $receita = $this->receitaRepository->update($data);
        return self::redirect($receita, "atualizar", "home");
    }

    public function delete(string $id)
    {
        $delete = $this->receitaRepository->delete($id);
        return self::redirect($delete, "remover", "home");
    }
}
