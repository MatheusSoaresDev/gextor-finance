<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DespesaRecorrenteRepositoryInterface;
use App\Repositories\Contracts\ReceitaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository;
    private ReceitaRepositoryInterface $receitaRepository;

    public function __construct(DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository, ReceitaRepositoryInterface $receitaRepository)
    {
        $this->middleware('auth');
        $this->despesaRecorrenteRepository = $despesaRecorrenteRepository;
        $this->receitaRepository = $receitaRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            $despesas = $this->despesaRecorrenteRepository->getDespesaPorMes();
            $receitas = $this->receitaRepository->getReceitaPorMes();

            return view('home', [
                "despesas" => $despesas,
                "receitas" => $receitas
            ]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function changeData(Request $request)
    {
        $dados_data = $request->only("mes", "ano");

        $request->session()->put("data", [
            "mes" => $dados_data["mes"] ?? date("m"),
            "ano" => $dados_data["ano"] ?? date("Y"),
        ]);

        return redirect('home')->withSuccess("Data alterada com sucesso!");
    }
}
