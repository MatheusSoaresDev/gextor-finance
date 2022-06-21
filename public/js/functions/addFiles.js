function anexarArquivo(formObj){
    const tipo = formObj.classList[1];
    const form = formObj.classList[2];
    const id = formObj.classList[3];

    const myForm = document.getElementById(form);
    const formData = new FormData(myForm);

    //Objetos modal
    const spinner = $("#spinner-"+tipo);
    const tbody = $("#tbody-"+tipo);

    formData.append('tipo', tipo);
    formData.append('id', id);

    $.ajax({
        type:'POST',
        //dataType: 'json',
        url: '/file/'+tipo+'/anexar',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend : function (){
            spinner.css("display", 'block');
        },
        error: function (xhr){
            spinner.css("display", 'none');
            $.notify("Não foi possível anexar o arquivo!", "error");
        },
        success: function(response){
            spinner.css("display", "none");

            tbody.append(`
                <tr>
                    <th scope="row">${$("#table-"+tipo+" tr").length}</th>
                    <td>${response.nome_original}</td>
                    <td>${response.tipo}</td>
                    <td>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="">Selecione</option>
                            <option value="b">Boleto</option>
                            <option value="c">Comprovante</option>
                            <option value="cc">Contracheque</option>
                        </select>
                    </td>
                    <td>
                        <a href="/file/receita/${response.id}" target="_blank"><button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file"></i></button></a>
                        <button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-file-arrow-down"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            `);
        }
    });
}

function selectedTipo(tipoArquivo, tipoOption){
    if(tipoArquivo == tipoOption){
        return 'selected';
    }

    return null;
}

