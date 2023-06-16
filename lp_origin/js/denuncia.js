// Exemplo de código JavaScript
document.querySelectorAll('.btn-denunciar').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var comentarioId = this.dataset.idComentario;
      exibirFormularioDenuncia(comentarioId);
    });
  });
  
  function exibirFormularioDenuncia(comentarioId) {
    // Obter o título do comentário com base no ID do comentário
    var tituloComentario = obterTituloComentario(comentarioId);
  
    // Criar o formulário de denúncia
    var formulario = document.createElement('form');
    formulario.id = 'formulario-denuncia';
    formulario.dataset.comentarioId = comentarioId;
  
    // Título do comentário
    var titulo = document.createElement('h3');
    titulo.textContent = 'Denunciar Comentário';
    formulario.appendChild(titulo);
  
    // Título do comentário
    var tituloComentarioLabel = document.createElement('label');
    tituloComentarioLabel.textContent = 'Título do Comentário:';
    formulario.appendChild(tituloComentarioLabel);
  
    var tituloComentarioInput = document.createElement('input');
    tituloComentarioInput.type = 'text';
    tituloComentarioInput.value = tituloComentario;
    formulario.appendChild(tituloComentarioInput);
  
    // Descrição da denúncia
    var descricaoDenunciaLabel = document.createElement('label');
    descricaoDenunciaLabel.textContent = 'Motivo da Denúncia:';
    formulario.appendChild(descricaoDenunciaLabel);
  
    var descricaoDenunciaTextarea = document.createElement('textarea');
    descricaoDenunciaTextarea.rows = 4;
    formulario.appendChild(descricaoDenunciaTextarea);
  
    // Botão de enviar denúncia
    var btnEnviar = document.createElement('button');
    btnEnviar.type = 'submit';
    btnEnviar.textContent = 'Enviar Denúncia';
    formulario.appendChild(btnEnviar);
  
    // Evento de envio do formulário de denúncia
    formulario.addEventListener('submit', function(event) {
      event.preventDefault();
      var motivoDenuncia = descricaoDenunciaTextarea.value;
      enviarDenuncia(comentarioId, tituloComentario, motivoDenuncia);
    });
  
    // Exibir o formulário na página
    var modal = document.getElementById('modal-denuncia'); // ID do modal onde você deseja exibir o formulário
    modal.innerHTML = ''; // Limpar o conteúdo do modal antes de adicionar o formulário
    modal.appendChild(formulario);
  }
  
  