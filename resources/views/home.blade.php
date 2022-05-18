@extends('layouts.app')

@section('content')

    <div class="content">
        <h3 class=""> Dashboard </h3>

        @if ($errors->any())
            <div class="alert alert-danger mt-3 d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    <p>@error('nome') {{ $message }} @enderror</p>
                </div>
            </div>
        @endif

        <div class="row mt-4" style="margin-bottom: 1.875em; background-color: #e3f2fd; padding: 20px;">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-sm">
                        <h3> Controle Mensal </h3>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <h3>{{ session()->get('data')['mes'] }} - {{ session()->get('data')['ano'] }}</h3>
                    </div>
                    <div class="col-sm" style="text-align: right;">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#filtrarModal"><i class="fa fa-filter"></i>&nbspFiltrar</button>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-pills mt-5" id="pills-tab" role="tablist">
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
                            <th>Valor</th>
                            <th>Forma de pagamento</th>
                            <th>Status</th>
                            <th style="text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($despesasRecorrentes as $despesas)
                            <tr>
                                <td><span class="name">{{ $despesas->nome }}</span></td>
                                <td> R$ {{ $despesas->valor }} </td>
                                <td> {{ $despesas->forma_pagamento }} </td>
                                <td>
                                    @if($despesas->status == 1)
                                        <span class="badge text-bg-success">Pago</span>
                                    @else
                                        <span class="badge text-bg-secondary">Não Pago</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <form method="POST" action="{{ route('despesaRecorrente') }}" onsubmit="return confirm('Tem certeza que deseja remover essa despesa?');">
                                        @method('delete')
                                        <a data-toggle="tooltip" data-placement="top" title="Editar"><button type="button" class="btn btn-outline-primary btn-sm" onclick="editarDespesa({{ $despesas }});"><i class="fa fa-edit"></i></button></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Excluir"><button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-times-circle-o"></i></button></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    <tr>
                        <td colspan="5" style="text-align: center;"><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#criardespesarecorrentemodal">Adicionar</button></td>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
                            <input type="text" id="valor_despesa_recorrente" name="valor" placeholder="Valor base da despesa" class="form-control" data-mask="000.000.000.000.000,00" data-mask-reverse="true" required>
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

    <script type="text/javascript" src="{{ asset('js/validators/CreateDespesaValidator.js') }}"></script>

@endsection
