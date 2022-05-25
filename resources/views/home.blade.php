@extends('layouts.app')

@section('content')

    <div class="content">
        <h3 class=""> Dashboard </h3>
        <small> {{ session('success') }} </small>
        <small> {{ session('error') }} </small>

        <div class="row mt-4" style="--bs-gutter-x: 0;">
            <div class="col-sm-3">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0;bottom: 0;left: 0;right: 0;margin: auto;left: 50%;justify-content: center;display: flex;">
                            <i class="fa-solid fa-sack-dollar" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Receitas
                                <h5> R$ {{ number_format($despesasRecorrentes->sum('valor'), 2, ',', '.') }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0;bottom: 0;left: 0;right: 0;margin: auto;left: 50%;justify-content: center;display: flex;">
                            <i class="fa-solid fa-repeat" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Despesas Recorrentes
                                <h5> R$ {{ number_format($despesasRecorrentes->sum('valor'), 2, ',', '.') }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0;bottom: 0;left: 0;right: 0;margin: auto;left: 50%;justify-content: center;display: flex;">
                            <i class="fa-solid fa-divide" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Despesas Anuais
                                <h5> R$ {{ number_format($despesasRecorrentes->sum('valor'), 2, ',', '.') }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-3" style="max-width: 340px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="top: 0;bottom: 0;left: 0;right: 0;margin: auto;left: 50%;justify-content: center;display: flex;">
                            <i class="fa-solid fa-credit-card" style="font-size: 30px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                Cartões de crédito
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
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Despesas Recorrentes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Despesas Parceladas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Cartões</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active p-4" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
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
                        @foreach($despesasRecorrentes as $despesas)
                            <tr style="vertical-align:middle">
                                <td><span class="name">{{ $despesas->nome }}</span></td>
                                <td> {{ ucfirst($despesas->forma_pagamento) }} </td>
                                <td> R$ {{ number_format($despesas->valor, 2, ',') }} </td>
                                <td>
                                    @if($despesas->status == 1)
                                        <span class="badge text-bg-success">Pago</span>
                                    @else
                                        <span class="badge text-bg-secondary">Não Pago</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="cursor: pointer;">
                                            <li><a class="dropdown-item" onclick="editarDespesaRecorrenteModal({{ $despesas }});">Editar</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>

                                            <form method="POST" id="formExcluirDespesaRecorrente{{ $despesas->id }}" action="{{ route('deleteDespesaRecorrente', $despesas->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <li><a onclick="submit('{{ $despesas->id }}')" class="dropdown-item" href="#">Excluir</a></li>
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
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
        </div>
    </div>

    <div class="modal fade" id="filtrarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Filtrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="{{ route('home') }}">
                    <div class="modal-body">

                        <div class="row form-group">
                            <div class="col-12 col-md-12">
                                <label for="select"></label>
                                <select name="ano" id="select" class="form-control" required>
                                    <option value="">Selecione o ano</option>
                                    {{ $ano = date("Y") }}
                                    @while ($ano <= 2035)
                                        <option value="{{ $ano }}">{{ $ano }}</option>
                                        {{ $ano++ }}
                                    @endwhile
                                </select>
                            </div>

                            <div class="col-12 col-md-12">
                                <label for="select"></label>
                                <select name="mes" id="select" class="form-control" required>
                                    <option value="">Selecione o mês</option>
                                    <option value="01">Janeiro</option>
                                    <option value="02">Fevereiro</option>
                                    <option value="03">Março</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Maio</option>
                                    <option value="06">Junho</option>
                                    <option value="07">Julho</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Setembro</option>
                                    <option value="10">Outubro</option>
                                    <option value="11">Novembro</option>
                                    <option value="12">Dezembro</option>
                                </select>
                            </div>
                        </div>

                        {{ csrf_field() }}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="criardespesarecorrentemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Registrar despesa do mês</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('despesaRecorrente') }}" id="criarDespesaRecorrente">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="nome_despesa_recorrente" class="form-label">Nome da despesa</label>
                            <input type="text" class="form-control" name="nome" placeholder="Nome da despesa" id="nome_despesa_recorrente" aria-describedby="emailHelp" required>
                        </div>

                        <div class="mb-3">
                            <label for="valor_despesa_recorrente" class="form-label">Valor</label>
                            <input type="text" id="valor_despesa_recorrente" name="valor" placeholder="Valor base da despesa" class="form-control" data-mask="000.000.000.000.000.00" data-mask-reverse="true" required>
                        </div>

                        <div class="mb-3">
                            <label for="forma_pagamento_despesa_recorrente" class="form-label">Forma de Pagamento</label>
                            <select name="forma_pagamento" id="forma_pagamento_despesa_recorrente" class="form-control" required>
                                <option value="">Forma de pagamento</option>
                                <option value="boleto">Boleto</option>
                                <option value="pix">Pix</option>
                                <option value="debito">Débito automático</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comentario_despesa_recorrente" class="form-label">Comentário</label>
                            <textarea type="text" id="comentario_despesa_recorrente" name="comentario" placeholder="Comentário" class="form-control" required></textarea>
                        </div>

                        {{ csrf_field() }}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editardespesarecorrentemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Editar despesa do mês</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('despesaRecorrente') }}" id="EditarDespesaRecorrente" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('put')

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="dadosEditar-tab" data-bs-toggle="pill" data-bs-target="#dadosEditar" type="button" role="tab" aria-controls="dadosEditar" aria-selected="true">Dados</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="arquivos-tab" data-bs-toggle="pill" data-bs-target="#arquivos" type="button" role="tab" aria-controls="arquivos" aria-selected="false">Arquivos</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="dadosEditar" role="tabpanel" aria-labelledby="dadosEditar-tab" tabindex="0">

                                <input type="hidden" id="editar_id_despesa_recorrente" name="id">

                                <div class="mb-3">
                                    <label for="editar_nome_despesa_recorrente" class="form-label">Nome da despesa</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Nome da despesa" id="editar_nome_despesa_recorrente" aria-describedby="emailHelp" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editar_valor_despesa_recorrente" class="form-label">Valor</label>
                                    <input type="text" id="editar_valor_despesa_recorrente" name="valor" placeholder="Valor base da despesa" class="form-control" data-mask="000.000.000.000.000.00" data-mask-reverse="true" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editar_forma_pagamento_despesa_recorrente" class="form-label">Forma de Pagamento</label>
                                    <select name="forma_pagamento" id="editar_forma_pagamento_despesa_recorrente" class="form-control" required>
                                        <option value="">Forma de pagamento</option>
                                        <option value="boleto">Boleto</option>
                                        <option value="pix">Pix</option>
                                        <option value="debito">Débito automático</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="editar_status_despesa_recorrente" class="form-label">Status</label>
                                    <select name="status" id="editar_status_despesa_recorrente" class="form-control" required>
                                        <option value="0">Não Pago</option>
                                        <option value="1">Pago</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="editar_data_despesa_recorrente" class="form-label">Data da despesa</label>
                                    <input type="date" id="editar_data_despesa_recorrente" name="data" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editar_comentario_despesa_recorrente" class="form-label">Comentário</label>
                                    <textarea type="text" id="editar_comentario_despesa_recorrente" name="comentario" placeholder="Comentário" class="form-control" required></textarea>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="arquivos" role="tabpanel" aria-labelledby="arquivos-tab" tabindex="0">

                                <div class="mb-3 mt-4">
                                    <label for="editar_valor_despesa_recorrente" class="form-label">Boleto ou Fatura</label>
                                    <div class="input-group">
                                        <input type="file" name="boleto" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    </div>
                                </div>

                                <div class="mb-3 mt-4">
                                    <label for="editar_valor_despesa_recorrente" class="form-label">Comprovante de pagamento</label>
                                    <div class="input-group">
                                        <input type="file" name="comprovante" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/validators/CreateDespesaValidator.js') }}"></script> <!-- Validator do formulário de criação de despesa recorrente -->
    <script type="text/javascript" src="{{ asset('js/validators/EditarDespesaValidator.js') }}"></script> <!-- Validator do formulário de edição de despesa recorrente -->
    <script type="text/javascript" src="{{ asset('js/functions/editarDespesaRecorrenteModal.js') }}"></script> <!-- Abrir modal de edição de despesa recorrente -->
    <script type="text/javascript" src="{{ asset('js/functions/submitEditarDespesaRecorrente.js') }}"></script> <!-- Função para dar submit na exclusão da despesa recorrente -->

@endsection
