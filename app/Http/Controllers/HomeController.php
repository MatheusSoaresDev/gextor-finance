<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DespesaParceladaRepositoryInterface;
use App\Repositories\Contracts\DespesaRecorrenteRepositoryInterface;
use App\Repositories\Contracts\ReceitaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository;
    private ReceitaRepositoryInterface $receitaRepository;
    private DespesaParceladaRepositoryInterface $despesaParceladaRepository;

    public function __construct(DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository,
                                ReceitaRepositoryInterface $receitaRepository,
                                DespesaParceladaRepositoryInterface $despesaParceladaRepository)
    {
        $this->middleware('auth');

        $this->despesaRecorrenteRepository = $despesaRecorrenteRepository;
        $this->receitaRepository = $receitaRepository;
        $this->despesaParceladaRepository = $despesaParceladaRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            $receitas = $this->receitaRepository->getMes();
            $despesasRecorrentes = $this->despesaRecorrenteRepository->getMes();
            //$despesasParceladas = $this->despesaParceladaRepository->getParcelasMes();


            return view('home', [
                "receitas" => $receitas,
                "despesasRecorrentes" => $despesasRecorrentes,
                //"despesasParceladas" => $despesasParceladas
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
