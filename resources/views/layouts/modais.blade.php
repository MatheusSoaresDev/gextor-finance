<div class="modal fade" id="filtrarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Filtrar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('changeData') }}">
                <div class="modal-body">
                    @method('PUT')

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

<div class="modal fade" id="criarreceitamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Registrar Receitas do mês</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('receita') }}" id="criarReceita">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="nome_receita" class="form-label">Nome da receita</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome da receita" id="nome_receita" aria-describedby="emailHelp" required>
                        <div id="validationServer03Feedback" class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="valor_receita" class="form-label">Valor</label>
                        <input type="text" id="valor_receita" name="valor" placeholder="Valor base da despesa" class="form-control" data-mask="000.000.000.000.000,00" data-mask-reverse="true" required>
                        <div id="validationServer03Feedback" class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="comentario_receita" class="form-label">Comentário</label>
                        <textarea type="text" id="comentario_receita" name="comentario" placeholder="Comentário" class="form-control"></textarea>
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
<div class="modal fade" id="editarreceitamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Editar receita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" onclick="diminuiModal('editarreceitamodal')" id="dadosEditar-tab" data-bs-toggle="pill" data-bs-target="#dadosEditar" type="button" role="tab" aria-controls="dadosEditar" aria-selected="true">Dados</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" onclick="aumentaModal('editarreceitamodal')" id="arquivos-tab-receita" data-bs-toggle="pill" data-bs-target="#arquivos-receita" type="button" role="tab" aria-controls="arquivos-receita" aria-selected="false">Arquivos</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="dadosEditar" role="tabpanel" aria-labelledby="dadosEditar-tab" tabindex="0">
                        <form method="POST" action="{{ route('receita') }}" id="editarReceita" onsubmit="return confirm('Tem certeza que deseja editar essa receita?');">
                            @csrf
                            @method('put')

                            <input type="hidden" id="editar_id_receita" name="id">

                            <div class="mb-3">
                                <label for="editar_nome_receita" class="form-label">Nome da receita</label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome da receita" id="editar_nome_receita" aria-describedby="emailHelp" required>
                                <div id="validationServer03Feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="editar_valor_receita" class="form-label">Valor</label>
                                <input type="text" id="editar_valor_receita" name="valor" placeholder="Valor da receita" class="form-control" data-mask="000.000.000.000.000,00" data-mask-reverse="true" required>
                                <div id="validationServer03Feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="editar_status_receita" class="form-label">Status</label>
                                <select name="status" id="editar_status_receita" class="form-control" required>
                                    <option value="0">Não Pago</option>
                                    <option value="1">Pago</option>
                                </select>
                                <div id="validationServer03Feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="editar_data_receita" class="form-label">Data da receita</label>
                                <input type="date" id="editar_data_receita" name="data" class="form-control" required>
                                <div id="validationServer03Feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="editar_comentario_receita" class="form-label">Comentário</label>
                                <textarea type="text" id="editar_comentario_receita" name="comentario" placeholder="Comentário" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="arquivos-receita" role="tabpanel" aria-labelledby="arquivos-tab-receita" tabindex="0">
                        <table class="table" id="table-receita" style="text-align: center; vertical-align: middle">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Formato</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-receita">

                                <!-- Corpo da tabela; -->

                            </tbody>
                        </table>

                        <div style="margin-bottom: 14px; display: none;" class="text-center" id="spinner-receita">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 col-3 mx-auto">
                            <form method="POST" id="addFileReceitaForm" enctype="multipart/form-data">
                                @csrf
                                <label for="file-upload" class="custom-file-upload receita btn btn-primary"><i class="fa-solid fa-plus"></i>&nbspAdicionar arquivo</label>
                                <input id="file-upload" onchange="anexarArquivo(this, 'addFileReceitaForm', 'receita')" name="file" class="input-file" type="file"/>
                                <input type="hidden" id="id_receita" name="id" value="">
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button form="editarReceita" type="submit" class="btn btn-success">Editar</button>
            </div>
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
                            <option value="b">Boleto</option>
                            <option value="p">Pix</option>
                            <option value="d">Débito automático</option>
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

            <div class="modal-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" onclick="diminuiModal('editardespesarecorrentemodal')" id="dadosEditar-tab" data-bs-toggle="pill" data-bs-target="#dadosEditar-despesa-recorrente" type="button" role="tab" aria-controls="dadosEditar" aria-selected="true">Dados</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" onclick="aumentaModal('editardespesarecorrentemodal')" id="arquivos-tab-despesa-recorrente" data-bs-toggle="pill" data-bs-target="#arquivos-despesa-recorrente" type="button" role="tab" aria-controls="arquivos" aria-selected="false">Arquivos</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="dadosEditar-despesa-recorrente" role="tabpanel" aria-labelledby="dadosEditar-tab" tabindex="0">
                        <form method="POST" action="{{ route('despesaRecorrente') }}" id="editarDespesaRecorrente" onsubmit="return confirm('Tem certeza que deseja editar essa despesa?');">
                            @csrf
                            @method('put')

                            <input type="hidden" id="editar_id_despesa_recorrente" name="id">

                            <div class="mb-3">
                                <label for="editar_nome_despesa_recorrente" class="form-label">Nome da despesa</label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome da despesa" id="editar_nome_despesa_recorrente" aria-describedby="emailHelp" required>
                            </div>

                            <div class="mb-3">
                                <label for="editar_valor_despesa_recorrente" class="form-label">Valor</label>
                                <input type="text" id="editar_valor_despesa_recorrente" name="valor" placeholder="Valor base da despesa" class="form-control" data-mask="000.000.000.000.000,00" data-mask-reverse="true" required>
                            </div>

                            <div class="mb-3">
                                <label for="editar_forma_pagamento_despesa_recorrente" class="form-label">Forma de Pagamento</label>
                                <select name="forma_pagamento" id="editar_forma_pagamento_despesa_recorrente" class="form-control" required>
                                    <option value="">Forma de pagamento</option>
                                    <option value="b">Boleto</option>
                                    <option value="p">Pix</option>
                                    <option value="d">Débito automático</option>
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
                        </form>
                    </div>
                    <div class="tab-pane fade" id="arquivos-despesa-recorrente" role="tabpanel" aria-labelledby="arquivos-tab-despesa-recorrente" tabindex="0">
                        <table class="table" id="table-despesa-recorrente" style="text-align: center; vertical-align: middle">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Formato</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody id="tbody-despesaRecorrente">

                            <!-- Corpo da tabela; -->

                            </tbody>
                        </table>

                        <div style="margin-bottom: 14px; display: none;" class="text-center" id="spinner-despesaRecorrente">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 col-3 mx-auto">
                            <form method="POST" id="addFileDespesaRecorrenteForm" enctype="multipart/form-data">
                                @csrf
                                <label for="file-upload-despesa-recorrente" class="custom-file-upload receita btn btn-primary"><i class="fa-solid fa-plus"></i>&nbspAdicionar arquivo</label>
                                <input id="file-upload-despesa-recorrente" onchange="anexarArquivo(this, 'addFileDespesaRecorrenteForm', 'despesaRecorrente')" name="file" class="input-file" type="file"/>
                                <input type="hidden" id="id_despesa_recorrente" name="id" value="">
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button form="editarDespesaRecorrente" type="submit" class="btn btn-success">Editar</button>
            </div>
        </div>
    </div>
</div>

<style>

    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }

</style>

<!-- Arquivos -->

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.modal').on('hide.bs.modal', function (event) {
        $(".error").remove();
        $(".is-invalid").removeClass("is-invalid");
    })
</script>

<script type="text/javascript" src="{{ asset('js/functions/editarReceitaModal.js') }}"></script> <!-- Abrir modal de edição de receita -->
<script type="text/javascript" src="{{ asset('js/functions/editarDespesaRecorrenteModal.js') }}"></script> <!-- Abrir modal de edição de receita -->

<script type="text/javascript" src="{{ asset('js/functions/submitDelete.js') }}"></script> <!-- Função para dar submit na exclusão -->

<script type="text/javascript" src="{{ asset('js/functions/aumentaDiminuiModal.js') }}"></script> <!-- Função para dar submit na exclusão da despesa recorrente -->

<script type="text/javascript" src="{{ asset('js/functions/arquivos/addFiles.js') }}"></script> <!-- Função para adicionar Arquivos -->
<script type="text/javascript" src="{{ asset('js/functions/arquivos/listFiles.js') }}"></script> <!-- Função para listar os arquivos de cada categoria -->
<script type="text/javascript" src="{{ asset('js/functions/arquivos/alterarTipo.js') }}"></script> <!-- Função para listar os arquivos de cada categoria -->
<script type="text/javascript" src="{{ asset('js/functions/arquivos/removeFile.js') }}"></script> <!-- Função para listar os arquivos de cada categoria -->

<script type="text/javascript" src="{{ asset('js/functions/submitDelete.js') }}"></script> <!-- Abrir modal de edição de despesa recorrente -->
