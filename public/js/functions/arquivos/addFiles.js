function anexarArquivo(formObj, idForm, tipo){
    const myForm = document.getElementById(idForm);
    const formData = new FormData(myForm);
    const buttonFile = $(".custom-file-upload, ."+tipo);

    //Objetos modal
    const spinner = $("#spinner-"+tipo);
    const tbody = $("#tbody-"+tipo);

    const id = formData.getAll("id");
    formData.append('tipo', tipo);

    $.ajax({
        type:'post',
        //dataType: 'json',
        url: '/file/'+tipo+'/',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend : function (){
            spinner.css("display", 'block');
            buttonFile.addClass("disabled");
        },
        error: function (xhr){
            buttonFile.removeClass("disabled");
            spinner.css("display", 'none');
            $.notify("Não foi possível anexar o arquivo!", "error");
        },
        success: function(response){
            $("#tr-not-file-"+tipo).remove(); //remove a linha que informa caso não haja arquivos anexados.

            buttonFile.removeClass("disabled");
            spinner.css("display", "none");

            tbody.append(`
                <tr id="${response.id}">
                    <td>${response.nome_original}</td>
                    <td>${response.tipo}</td>
                    <td>
                        <select class="form-select form-select-sm" id="selectTipo${response.id}" aria-label=".form-select-sm example" onchange="alterarTipo('${id}', '${response.id}', this, '${tipo}', '${response.tipo_documento}')">
                            <option value="">Selecione</option>
                            <option value="b" ${selectedTipo(response.tipo_documento, 'b')}>Boleto</option>
                            <option value="c" ${selectedTipo(response.tipo_documento, 'c')}>Comprovante</option>
                            <option value="cc" ${selectedTipo(response.tipo_documento, 'cc')}>Contracheque</option>
                        </select>
                    </td>
                    <td>
                        <a href="/file/receita/view/${response.id}" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file"></i></button></a>
                        <a href="/file/receita/download/${response.id}"><button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-file-arrow-down"></i></button></a>
                        <button type="button" onclick="removeFile('${id}', '${response.id}', '${tipo}')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `);
        }
    });
}
