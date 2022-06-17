function editarReceitaModal(receita){
    console.log(receita);
    const valorSemPonto = parseFloat(receita.valor);

    $("#editar_id_receita").val(receita.id);
    $("#editar_nome_receita").val(receita.nome);
    $("#editar_valor_receita").val(valorSemPonto.toFixed(2));
    $("#editar_status_receita").val(receita.status);
    $("#editar_data_receita").val(receita.data);
    $("#editar_comentario_receita").val(receita.comentario);

    $('#editarreceitamodal').modal('show');
}
