function favoritarFilme(event) {
    event.preventDefault();
    const button = event.target;

    // Adicione ou remova a classe 'favorito-ativo' para alterar a cor do ícone
    button.classList.toggle('favorito-ativo');
  }