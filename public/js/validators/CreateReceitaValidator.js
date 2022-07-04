jQuery(document).ready(function(){
    jQuery('#criarReceita').validate({
        rules: {
            // Os campos já são auto declarados no formulário;
        },
        highlight: function (input) {
            $(input).addClass('is-invalid');
        },
        unhighlight: function (input) {
            $(input).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
            $(element).next().append(error);
        }
    });
});
