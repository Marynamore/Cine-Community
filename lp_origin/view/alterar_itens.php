<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $usuarioLogado = "";
}

require_once '../model/dao/ItemDAO.php';

$id = isset($_GET["id"]) ? $_GET["id"] : null;

if ($id) {
    $ItemDAO = new ItemDAO();
    $itens = $ItemDAO->buscarPorID($id);

    if ($itens) {
        // O item foi encontrado, preencha os campos do formulário com os valores correspondentes
        $id_item = $itens->getId_item();
        $imagem_item = $itens->getImagem_item();
        $nome_item = $itens->getNome_item();
        $descricao_item = $itens->getDescricao_item();
        $fk_id_categoria_item = $itens->getFk_id_categoria_item();
        $preco_item = $itens->getPreco_item();
    } else {
        echo "Item não encontrado.";
        exit;
    }
} else {
    echo "ID do item não fornecido.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formularioitens.css">
    <title>Alterar item</title>
</head>

<body>
    <a href="../view/dashboard/listaitensmod.php"><input type="submit" value="Voltar"></a>
    <h1>Alterar item</h1>
    <center>
        <div class="container">
            <form action="../control/control_alterar_itens.php" method="post">
                <input type="hidden" name="id_item" value="<?= $id_item; ?>">
                <input type="hidden" name="id_usuario" value="<?= $id_usuarioLogado; ?>">
                <input type="hidden" name="id_perfil" value="<?= $id_perfil; ?>">
                Poster do item:
                <input type="file" name="imagem_item" value="<?= $imagem_item; ?>"><br><br>
                Nome do item:
                <input type="text" name="nome_item" placeholder="Item" value="<?= $nome_item; ?>"> <br> <br>
                Data de lançamento:
                <input type="text" name="preco_item" placeholder="Data de lançamento" value="<?= $preco_item; ?>"><br><br>

                <label for="categoria_itens">Categoria:</label>
                <select name="fk_id_categoria_item" id="categoria_itens">
                    <option value="1" <?= ($fk_id_categoria_item == 1) ? 'selected' : ''; ?>>Livros e Revistas</option>
                    <option value="2" <?= ($fk_id_categoria_item == 2) ? 'selected' : ''; ?>>Filmes e Séries</option>
                    <option value="3" <?= ($fk_id_categoria_item == 3) ? 'selected' : ''; ?>>Posters e Pôsteres</option>
                </select>
                Duração:
                <input type="text" name="qtd_item" placeholder="Duração" value="<?= $qtd_item; ?>"> <br><br>

                <input type="submit" value="Alterar">
            </form>
        </div>
    </center>
</body>

</html>