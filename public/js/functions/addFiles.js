/*$('#file-upload').on("change", function(){
    const tipo = this.classList[1];
    const form = this.classList[2];
    const id = this.classList[3];


    console.log((myForm));
});*/

function anexarArquivo(formObj){
    const tipo = formObj.classList[1];
    const form = formObj.classList[2];
    const id = formObj.classList[3];

    const myForm = document.getElementById(form);
    const formData = new FormData(myForm);

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

        },
        error: function (xhr){

        },
        success: function(response){

        }
    });
}


