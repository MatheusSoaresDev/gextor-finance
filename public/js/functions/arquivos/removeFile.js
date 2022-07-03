function removeFile(idObj, id_file, tipo){
    if (window.confirm("Você realmente quer remover essa receita?")) {
        const json = {
            id_obj : idObj,
            id_file : id_file,
        };

        $.ajax({
            type:'delete',
            dataType: 'json',
            data: json,
            url: '/file/'+tipo+'/',
            beforeSend : function (){
                $.notify("Apagando o arquivo. Aguarde...", "info");
            },
            error: function (xhr){
                $.notify("Não foi possível deletar o arquivo. Tente Novamente!", "error");
            },
            success: function(response){
                $($("#"+id_file)).remove();
                $.notify("Deletado com sucesso!", "success");
            }
        });
    }
}
