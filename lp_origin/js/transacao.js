const modal = document.getElementById("modal");
const opcaoSelecionada = document.getElementById("opcaoSelecionada");

function mostrarModal() {
  const select = document.getElementById("opcoes");
  const opcao = select.options[select.selectedIndex].text;

  if (opcao !== "") {
    opcaoSelecionada.textContent = "Opção selecionada: " + opcao;
    modal.classList.add("open");
  } else {
    fecharModal();
  }
}

function fecharModal() {
  modal.classList.remove("open");
}