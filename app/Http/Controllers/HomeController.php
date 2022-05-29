<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DespesaRecorrenteRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository;

    public function __construct(UserRepositoryInterface $userRepository, DespesaRecorrenteRepositoryInterface $despesaRecorrenteRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->despesaRecorrenteRepository = $despesaRecorrenteRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            //$this->session_date($request);

            $despesasRecorrentes = $this->despesaRecorrenteRepository->getDespesaPorMes();

            return view('home', compact('despesasRecorrentes'));
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
