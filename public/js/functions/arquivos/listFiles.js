function listarArquivos(idObj, tipo){
    //Objetos modal
    const spinner = $("#spinner-"+tipo);
    const tbody = $("#tbody-"+tipo);
    const buttonFile = $(".custom-file-upload, ."+tipo);

    $.ajax({
        type:'GET',
        //dataType: 'json',
        url: '/file/'+tipo+'/'+idObj,
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
            spinner.css("display", "none");
            tbody.append(`
                <tr id="tr-not-file-${tipo}">
                    <td colspan="5">Não há arquivos anexados!</td>
                </tr>
            `);
        },
        success: function(response){
            spinner.css("display", "none");
            buttonFile.removeClass("disabled");

            for(let i=0; i<response.length; i++){
                tbody.append(`
                    <tr id="${response[i].id}">
                        <td>${response[i].nome_original}</td>
                        <td>${response[i].tipo}</td>
                        <td>
                            <select class="form-select form-select-sm" id="selectTipo${response[i].id}" aria-label=".form-select-sm example" onchange="alterarTipo('${idObj}', '${response[i].id}', this, '${tipo}', '${response[i].tipo_documento}')">
                                <option value="">Selecione</option>
                                <option value="b" ${selectedTipo(response[i].tipo_documento, 'b')}>Boleto</option>
                                <option value="c" ${selectedTipo(response[i].tipo_documento, 'c')}>Comprovante</option>
                                <option value="cc" ${selectedTipo(response[i].tipo_documento, 'cc')}>Contracheque</option>
                            </select>
                        </td>
                        <td>
                            <a href="/file/${tipo}/view/${response[i].id}" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file"></i></button></a>
                            <a href="/file/${tipo}/download/${response[i].id}"><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-file-arrow-down"></i></button></a>
                            <button type="button" onclick="removeFile('${idObj}', '${response[i].id}', '${tipo}')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                `)
            }
        }
    });
}

function selectedTipo(tipoArquivo, tipoOption){
    if(tipoArquivo === tipoOption){
        return 'selected';
    }
    return '';
}

