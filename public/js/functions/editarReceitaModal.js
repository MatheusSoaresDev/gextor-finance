function editarReceitaModal(receita){
    const valorSemPonto = parseFloat(receita.valor);

    $("#editar_id_receita").val(receita.id);
    $("#editar_nome_receita").val(receita.nome);
    $("#editar_valor_receita").val(valorSemPonto.toFixed(2));
    $("#editar_status_receita").val(receita.status);
    $("#editar_data_receita").val(receita.data);
    $("#editar_comentario_receita").val(receita.comentario);

    /**
     * Esse comando insere o id da receita na classe do file-upload da modal de receita.
     * Com isso eu consigo as informações necessárias para anexar o arquivo à minha receita.
     */
    $(".input-file.receita").addClass(receita.id);

    $('#editarreceitamodal').modal('show');
}
