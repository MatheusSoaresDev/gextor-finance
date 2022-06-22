function listarArquivos(id, tipo){
    //Objetos modal
    const spinner = $("#spinner-"+tipo);
    const tbody = $("#tbody-"+tipo);
    const buttonFile = $(".custom-file-upload, ."+tipo);

    $.ajax({
        type:'GET',
        //dataType: 'json',
        url: '/file/'+tipo+'/list/'+id,
        data: '',
        contentType: false,
        processData: false,
        beforeSend : function (){
            tbody.empty();
            buttonFile.addClass("disabled");
            spinner.css("display", "block");
        },
        error: function (xhr){
            buttonFile.removeClass("disabled");
            tbody.append(`
                <tr>
                    <td colspan="5">Não há arquivos anexados!</td>
                </tr>
            `);
        },
        success: function(response){
            spinner.css("display", "none");
            buttonFile.removeClass("disabled");

            for(let i=0; i<response.length; i++){
                tbody.append(`
                    <tr>
                        <th scope="row">${i+1}</th>
                        <td>${response[i].nome_original}</td>
                        <td>${response[i].tipo}</td>
                        <td>
                            <select class="form-select form-select-sm" id="selectTipo${response[i].id}" aria-label=".form-select-sm example" onchange="alterarTipo('${id}', '${response[i].id}', this, '${tipo}', '${response[i].tipo_documento}')">
                                <option value="">Selecione</option>
                                <option value="b" ${selectedTipo(response[i].tipo_documento, 'b')}>Boleto</option>
                                <option value="c" ${selectedTipo(response[i].tipo_documento, 'c')}>Comprovante</option>
                                <option value="cc" ${selectedTipo(response[i].tipo_documento, 'cc')}>Contracheque</option>
                            </select>
                        </td>
                        <td>
                            <a href=""><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file"></i></button></a>
                            <button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-file-arrow-down"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                `)
            }
        }
    });
}

function alterarTipo(idObj, id_file, selected, tipoDoc, tipoDocAtual){
    const tipo = selected.value;
    const json = {
            id_obj : idObj,
            id_file : id_file,
            tipo : tipo
        };

    $.ajax({
        type:'put',
        dataType: 'json',
        url: '/file/'+tipoDoc+'/altera/tipo',
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

function selectedTipo(tipoArquivo, tipoOption){
    if(tipoArquivo === tipoOption){
        return 'selected';
    }
    return '';
}
