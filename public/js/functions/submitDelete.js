function submitDelete(id, form, tipo) {
    if (window.confirm("Tem certeza que deseja remover essa "+tipo+"?")) {
        document.getElementById(form).submit();
    }
}
