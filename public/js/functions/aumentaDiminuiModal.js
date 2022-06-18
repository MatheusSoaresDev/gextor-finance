function aumentaModal(idModal){
    const modal = $("#"+idModal);
    //modal.children().removeClass("modal-sm");
    modal.children().addClass("modal-lg");

    return null;
}

function diminuiModal(idModal){
    const modal = $("#"+idModal);
    modal.children().removeClass("modal-lg");

    return null;
}
