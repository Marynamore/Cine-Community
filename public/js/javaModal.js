// Função para abrir o modal
function abrirModal(idModal) {
    var modal = document.getElementById(idModal);
    modal.style.display = "block";
}

// Função para fechar o modal
function fecharModal(idModal) {
    var modal = document.getElementById(idModal);
    modal.style.display = "none";
}

// Adicione eventos de clique aos botões para abrir os modais
document.getElementById("btnAbrirModalResenha").addEventListener("click", function() {
    abrirModal("modalResenha");
});

document.getElementById("btnAbrirModalDenuncia").addEventListener("click", function() {
    abrirModal("modalDenuncia");
});

