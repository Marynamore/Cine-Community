<?php
session_start();
require_once '../../model/dao/itemDAO.php';

$ItemDAO = new ItemDAO();

$usuarioLogado = $_SESSION["nickname_usu"];
$id_usuarioLogado = $_SESSION["id_usuario"];
$id_perfil = $_SESSION["id_perfil"];

if ($id_perfil == "colecionador") {
    echo "Apenas colecionadores podem acessar esta página.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/stylelista.css">
    <link rel="stylesheet" href="../../css/caixadepergunta.css">
    
    <title>Lista Colecionador</title>
</head>

<body>
    <?php
    $itens = $ItemDAO->listarTodosItensPorUsuario($id_usuarioLogado);

    ?>
    <a href="../dashboard/painel_colecionador.php">Voltar</a>
    <center>
        <h2>Lista de Itens</h2>
    </center>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade de Itens</th>
                <th>Categoria</th>
                <th>Capa</th>
                <th>Descrição</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itens as $item) : ?>
                <tr>
                    <td><?= $item["id_item"] ?></td>
                    <td><?= $item["nome_item"] ?></td>
                    <td><?= $item["preco_item"] ?></td>
                    <td><?= $item["qtd_item"] ?></td>
                    <td><?= $item["categoria_item"] ?></td>
                    <td><?= $item["imagem_item"] ?></td>
                    <td><?= $item["descricao_item"] ?></td>
                    <td>
                        <button class="editar">
                            <a href="../alterar_itens.php?id_item=<?= $item["id_item"] ?>" title="ALTERAR" class="editar">
                                Alterar<i class="bi bi-pencil"></i>
                            </a>
                        </button>
                        <button class="excluir">
                            <a href="../../control/excluir_item.php?id_item=<?= $item["id_item"] ?>" title="EXCLUIR" onclick="return confirm('Tem certeza que deseja excluir esse dado?')">
                                <i class="fa fa-trash fa-lg"></i> Excluir</a>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script>
function showConfirmation(message) {
    // Cria a caixa de diálogo de confirmação
    var dialog = document.createElement('div');
    dialog.classList.add('confirmation-dialog');

    // Adiciona a mensagem à caixa de diálogo
    var messageElement = document.createElement('p');
    messageElement.classList.add('message');
    messageElement.textContent = message;
    dialog.appendChild(messageElement);

    // Adiciona os botões de confirmação
    var confirmButton = document.createElement('button');
    confirmButton.textContent = 'Confirmar';
    confirmButton.addEventListener('click', function() {
        // Remove a caixa de diálogo
        dialog.remove();
        // Executa a ação de exclusão
        window.location.href = "../../control/excluir_item.php?id_item=<?= $item["id_item"] ?>";
    });
    var cancelButton = document.createElement('button');
    cancelButton.textContent = 'Cancelar';
    cancelButton.addEventListener('click', function() {
        // Remove a caixa de diálogo
        dialog.remove();
    });

    var buttonsContainer = document.createElement('div');
    buttonsContainer.classList.add('buttons');
    buttonsContainer.appendChild(confirmButton);
    buttonsContainer.appendChild(cancelButton);
    dialog.appendChild(buttonsContainer);

    // Adiciona a caixa de diálogo à página
    document.body.appendChild(dialog);

    // Cancela o evento de clique padrão do link
    return false;
}

</script>

</html>