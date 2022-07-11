function editarDespesaRecorrenteModal(despesa){
    const valorSemPonto = parseFloat(despesa.valor);
    const buttonUpload = $("#file-upload");

    $("#editar_id_despesa_recorrente").val(despesa.id);
    $("#editar_nome_despesa_recorrente").val(despesa.nome);
    $("#editar_valor_despesa_recorrente").val(valorSemPonto.toFixed(2));
    $("#editar_forma_pagamento_despesa_recorrente").val(despesa.forma_pagamento);
    $("#editar_status_despesa_recorrente").val(despesa.status);
    $("#editar_data_despesa_recorrente").val(despesa.data);
    $("#editar_comentario_despesa_recorrente").val(despesa.comentario);

    /**
     * Esse comando insere o id da receita na classe do file-upload da modal de receita.
     * Com isso eu consigo as informações necessárias para anexar o arquivo à minha receita.
     */

    $("#id_despesa_recorrente").val(despesa.id);

    listarArquivos(despesa.id, "despesaRecorrente");
    $('#editardespesarecorrentemodal').modal('show');
}
