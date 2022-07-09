function alterarTipo(idObj, id_file, selected, tipoDoc, tipoDocAtual){
    const tipo = selected.value;
    const json = {
        id_obj : idObj,
        id_file : id_file,
        tipo : tipo
    };

    console.log(json);

    $.ajax({
        type:'put',
        dataType: 'json',
        url: '/file/'+tipoDoc+'/',
        data: json,
        beforeSend : function (){
            $.notify("Processando alteração! Aguarde...", "info");
        },
        error: function (xhr){
            $("#selectTipo"+id_file).val(tipoDocAtual);
            $.notify("Não foi possível processar a alteração.", "error");
        },
        success: function(response){
            $.notify("Alterado com sucesso!", "success");
        }
    });
}
