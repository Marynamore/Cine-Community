<?php
session_start();

if (isset($_SESSION["id_usuario"])) {
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $id_usuarioLogado = "";
}

require_once '../model/dao/itemDAO.php';

$id_item = isset($_GET["id_item"]) ? $_GET["id_item"] : null;

if (!$id_item) {
    echo "ID do item não fornecido.";
    exit;
}

$ItemDAO = new ItemDAO();
$item = $ItemDAO->obterItemPorId($id_item);

if (!$item) {
    echo "Item não encontrado.";
    exit;
}

// O item foi encontrado, preencha os campos do formulário com os valores correspondentes
$id_item = $item->getId_item();
$imagem_item = $item->getImagem_item();
$nome_item = $item->getNome_item();
$descricao_item = $item->getDescricao_item();
$fk_id_categoria_item = $item->getFk_id_categoria_item();
$preco_item = $item->getPreco_item();
$qtd_item = $item->getQtd_item();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    <title>Alterar item</title>
</head>

<body>
    <button onclick="javascript:history.go(-1)" class="botao">Voltar</button>
    <h1>Alterar item</h1>
    <center>
        <div class="container">
            <form action="../control/alterar_itens_action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_item" value="<?= $id_item; ?>">
                <input type="hidden" name="fk_id_usuario" value="<?= $id_usuarioLogado; ?>">
                <input type="hidden" name="fk_id_perfil" value="<?= $id_perfil; ?>">
                <label for="imagem_item">Poster do item:</label>
                <input type="file" name="imagem_item" id="imagem_item"> <br><br>
                <label for="nome_item">Nome do item:</label>
                <input type="text" name="nome_item" id="nome_item" placeholder="Item" value="<?= $nome_item; ?>"> <br> <br>
                <label for="preco_item">Preço:</label>
                <input type="text" name="preco_item" id="preco_item" placeholder="Preço" value="<?= $preco_item; ?>"><br><br>
                <div class="form">
                    <textarea name="descricao_item" cols="30" rows="10" placeholder="DEIXE AQUI SUA DESCRIÇÃO" required></textarea>
                </div>
                <label for="categoria_item">Categoria do Item:</label>
                <select name="fk_id_categoria_item" id="categoria_item">
                    <option value="1" <?= ($fk_id_categoria_item == 1) ? 'selected' : ''; ?>>Livros e Revistas</option>
                    <option value="2" <?= ($fk_id_categoria_item == 2) ? 'selected' : ''; ?>>Filmes e Séries</option>
                    <option value="3" <?= ($fk_id_categoria_item == 3) ? 'selected' : ''; ?>>Posters e Pôsteres</option>
                </select>
                <label for="qtd_item">Quantidade de item:</label>
                <input type="text" name="qtd_item" id="qtd_item" placeholder="Quantidade de item" value="<?= $qtd_item; ?>"> <br><br>
                <input type="submit" value="Alterar">
            </form>
        </div>
    </center>
</body>

</html>
