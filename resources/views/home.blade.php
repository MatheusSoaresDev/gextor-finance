@extends('layouts.app')

@section('content')

    <div class="content">
        <h3 class=""> Dashboard </h3>
        <small> {{ session('success') }} </small>
        <small> {{ session('error') }} </small>

        <div class="row mt-4" style="--bs-gutter-x: 0;">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3" style="padding-right: 20px;">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0;bottom: 0; left: 0; right: 0; margin: auto; left: 50%; justify-content: center;display: flex;">
                            <i class="fa-solid fa-sack-dollar" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Receitas
                                <h5> R$ {{ number_format($receitas->sum('valor'), 2, ',', '.') }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3" style="padding-right: 20px;">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0;bottom: 0; left: 0; right: 0; margin: auto; left: 50%; justify-content: center;display: flex;">
                            <i class="fa-solid fa-repeat" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Recorrentes
                                <h5> R$ {{ number_format($despesasRecorrentes->sum('valor'), 2, ',', '.') }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3" style="padding-right: 20px;">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0; bottom: 0; left: 0; right: 0;margin: auto; left: 50%; justify-content: center;display: flex;">
                            <i class="fa-solid fa-divide" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Anuais
                                <h5> R$ {{ number_format($despesasRecorrentes->sum('valor'), 2, ',', '.') }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3" style="padding-right: 20px;">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0; bottom: 0; left: 0;right: 0; margin: auto; left: 50%; justify-content: center; display: flex;">
                            <i class="fa-solid fa-credit-card" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Cartões
                                <h5> R$ {{ number_format($despesasRecorrentes->sum('valor'), 2, ',', '.') }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center mt-4" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    &nbsp&nbsp{{ $errors->first() }}
                </div>
            </div>
        @endif

        <div class="row mt-3" style="margin-bottom: 1.875em; background-color: #e3f2fd; padding: 20px; --bs-gutter-x: 0;">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-sm">
                        <h3> Controle Mensal </h3>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <h3>{{ session()->get('data')['mes'] }} - {{ session()->get('data')['ano'] }}</h3>
                    </div>
                    <div class="col-sm" style="text-align: right;">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#filtrarModal"><i class="fa fa-filter"></i> &nbspFiltrar</button>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-pills mt-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-receita-tab" data-bs-toggle="pill" data-bs-target="#pills-receitas" type="button" role="tab" aria-controls="pills-receitas" aria-selected="true">Receitas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-despesa-recorrente-tab" data-bs-toggle="pill" data-bs-target="#pills-despesa-recorrente" type="button" role="tab" aria-controls="pills-despesa-recorrente" aria-selected="true">Despesas Recorrentes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-despesa-parcelada-tab" data-bs-toggle="pill" data-bs-target="#pills-despesa-parcelada" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Despesas Parceladas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Cartões</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade p-4" id="pills-receitas" role="tabpanel" aria-labelledby="pills-receita-tab" tabindex="0">
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($receitas as $receita)
                        <tr style="vertical-align:middle">
                            <td><span class="name">{{ $receita->nome }}</span></td>
                            <td> R$ {{ number_format($receita->valor, 2, ',', '.') }} </td>
                            <td>
                                @if($receita->status == 1)
                                    <span class="badge text-bg-success">Recebido</span>
                                @else
                                    <span class="badge text-bg-secondary">Aguardando</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-bars"></i>
                                    </button>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="cursor: pointer;">
                                        <li><a class="dropdown-item" onclick="editarReceitaModal({{ $receita }});">Editar</a></li>

                                        <form method="POST" id="formExcluirReceita{{ $receita->id }}" action="{{ route('deleteReceita', $receita->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <li><a onclick="submitDelete('{{ $receita->id }}', 'formExcluirReceita{{ $receita->id }}', 'receita')" class="dropdown-item" href="#">Excluir</a></li>
                                        </form>
                                    </ul>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" style="text-align: center;"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#criarreceitamodal"><i class="fas fa-plus"></i> &nbspAdicionar</button></td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- Receitas -->

            <div class="tab-pane fade p-4" id="pills-despesa-recorrente" role="tabpanel" aria-labelledby="pills-despesa-recorrente-tab" tabindex="0">
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Forma de pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($despesasRecorrentes as $despesaRecorrente)
                            <tr style="vertical-align:middle">
                                <td><span class="name">{{ $despesaRecorrente->nome }}</span></td>
                                <td> @if($despesaRecorrente->forma_pagamento == 'b') Boleto @elseif($despesaRecorrente->forma_pagamento == 'p') Pix @elseif($despesaRecorrente->forma_pagamento == 'd') Débito @endif</td>
                                <td> R$ {{ number_format($despesaRecorrente->valor, 2, ',', '.') }} </td>
                                <td>
                                    @if($despesaRecorrente->status == 1)
                                        <span class="badge text-bg-success">Pago</span>
                                    @else
                                        <span class="badge text-bg-secondary">Não Pago</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-bars"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="cursor: pointer;">
                                            <li><a class="dropdown-item" onclick="editarDespesaRecorrenteModal({{ $despesaRecorrente }});">Editar</a></li>

                                            <form method="POST" id="formExcluirDespesaRecorrente{{ $despesaRecorrente->id }}" action="{{ route('deleteDespesaRecorrente', $despesaRecorrente->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <!--<li><a onclick="submit('{{ $despesaRecorrente->id }}')" class="dropdown-item" href="#">Excluir</a></li>-->

                                                <li><a onclick="submitDelete('{{ $despesaRecorrente->id }}', 'formExcluirDespesaRecorrente{{ $despesaRecorrente->id }}', 'despesa')" class="dropdown-item" href="#">Excluir</a></li>
                                            </form>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    <tr>
                        <td colspan="5" style="text-align: center;"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#criardespesarecorrentemodal"><i class="fas fa-plus"></i> &nbspAdicionar</button></td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- Despesas Recorrentes -->

            <div class="tab-pane fade p-4 show active" id="pills-despesa-parcelada" role="tabpanel" aria-labelledby="pills-despesa-parcelada-tab" tabindex="0">  <!-- Despesas Parceladas -->
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Vencimento</th>
                            <th>Parcela</th>
                            <th>Forma de pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($despesasParceladas as $despesaParcelada)
                        @if(count($despesaParcelada->parcelas) > 0)
                            <tr style="vertical-align:middle">
                                <td><span class="name">{{ $despesaParcelada->nome }}</span></td>
                                <td><span class="name">{{ $despesaParcelada->data }}</span></td>
                                <td><span class="name">{{ $despesaParcelada->parcelas->first()->parcela}}</span></td>
                                <td> @if($despesaParcelada->forma_pagamento == 'b') Boleto @elseif($despesaParcelada->forma_pagamento == 'p') Pix @elseif($despesaParcelada->forma_pagamento == 'd') Débito @endif</td>
                                <td> R$ {{ number_format($despesaParcelada->parcelas->first()->valor, 2, ',', '.') }} </td>
                                <td><span class="name">{{ $despesaParcelada->parcelas->first()->status}}</span></td>
                                <td style="text-align: center;">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-bars"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="cursor: pointer;">
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                        <tr>
                            <td colspan="7" style="text-align: center;"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#criardespesaparceladamodal"><i class="fas fa-plus"></i> &nbspAdicionar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div> <!-- Cartões -->
        </div>
    </div>

    @include('layouts.modais')

    <script type="text/javascript" src="{{ asset('js/validators/CreateReceitaValidator.js') }}"></script> <!-- Validator do formulário de criação de receita -->
    <script type="text/javascript" src="{{ asset('js/validators/UpdateReceitaValidator.js') }}"></script> <!-- Validator do formulário de criação de receita -->

    <script type="text/javascript" src="{{ asset('js/validators/CreateDespesaValidator.js') }}"></script> <!-- Validator do formulário de criação de despesa recorrente -->
    <script type="text/javascript" src="{{ asset('js/validators/EditarDespesaValidator.js') }}"></script> <!-- Validator do formulário de edição de despesa recorrente -->

@endsection
