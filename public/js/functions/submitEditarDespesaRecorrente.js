function submit(id) {
    if (window.confirm("Tem certeza que deseja remover essa despesa?")) {
        document.getElementById("formExcluirDespesaRecorrente"+id).submit();
    }
}
