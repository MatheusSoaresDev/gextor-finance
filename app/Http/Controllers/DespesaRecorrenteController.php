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
        $data = $request->except("_token");

        $despesa = $this->despesaRecorrenteRepository->create($data);
        if($despesa){
            return redirect("home")->withSuccess('Despesa cadastrada com sucesso!');
        }
        return redirect("home")->withErrors('Não foi possivel cadastrar a despesa!');
    }

    public function delete(string $id)
    {
        $despesa = $this->despesaRecorrenteRepository->delete($id);
        if(!$despesa){
            return redirect("home")->withSuccess('Despesa removida com sucesso!');
        }
        return redirect("home")->withErrors('Não foi possivel remover a despesa!');
    }
}
