function listarArquivos(id, tipo){
    //Objetos modal
    const spinner = $("#spinner-"+tipo);
    const tbody = $("#tbody-"+tipo);

    $.ajax({
        type:'GET',
        //dataType: 'json',
        url: '/file/'+tipo+'/list/'+id,
        data: '',
        contentType: false,
        processData: false,
        beforeSend : function (){
            spinner.css("display", "block");
        },
        error: function (xhr){
            tbody.append(`
                <tr>
                    <td colspan="5">Não há arquivos anexados!</td>
                </tr>
            `);
        },
        success: function(response){
            spinner.css("display", "none");

            for(let i=0; i<response.length; i++){
                tbody.append(`
                    <tr>
                        <th scope="row">${i+1}</th>
                        <td>${response[i].nome_original}</td>
                        <td>${response[i].tipo}</td>
                        <td>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option value="1">Boleto</option>
                                <option value="2">Comprovante</option>
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
