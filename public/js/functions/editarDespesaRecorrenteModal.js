function editarDespesaRecorrenteModal(despesa){
    console.log(despesa);

    $("#editar_id_despesa_recorrente").val(despesa.id);
    $("#editar_nome_despesa_recorrente").val(despesa.nome);
    $("#editar_valor_despesa_recorrente").val(parseFloat(despesa.valor.toFixed(2)));
    $("#editar_forma_pagamento_despesa_recorrente").val(despesa.forma_pagamento);
    $("#editar_status_despesa_recorrente").val(despesa.status);
    $("#editar_data_despesa_recorrente").val(despesa.data);
    $("#editar_comentario_despesa_recorrente").val(despesa.comentario);

    $('#editardespesarecorrentemodal').modal('show');
}
