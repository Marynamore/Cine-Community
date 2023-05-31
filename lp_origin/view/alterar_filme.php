<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["fk_id_perfil"];
} else {
    $usuarioLogado = "";
}

require_once '../model/dao/filmeDAO.php';

$get_id = isset($_GET["get_id"]) ? $_GET["get_id"] : null;

if ($get_id) {
    $FilmeDAO = new FilmeDAO();
    $filme = $FilmeDAO->buscarPorID($get_id);

    if ($filme) {
        // O filme foi encontrado, preencha os campos do formulário com os valores correspondentes
        $id_filme = $filme->getId_filme();
        $capa_filme = $filme->getCapa_filme();
        $nome_filme = $filme->getNome_filme();
        $dt_de_lancamento_filme = $filme->getDt_de_lancamento_filme();
        $fk_id_categoria_filme = $filme->getFk_id_categoria_filme();
        $fk_id_canal_filme = $filme->getFk_id_canal_filme();
        $duracao_filme = $filme->getDuracao_filme();
        $classificacao_filme = $filme->getClassificacao_filme();
        $sinopse_filme = $filme->getSinopse_filme();
    } else {
        echo "Filme não encontrado.";
        exit;
    }
} else {
    echo "ID do filme não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    <title>Alterar filme</title>
</head>

<body>
    <h1>Alterar filme</h1>
    <center>
    <div class="borda">
        <form action="../control/control_alterar_filme.php" method="post">
            <input type="hidden" name="id_filme" value="<?= $id_filme; ?>">
            <input type="hidden" name="id_usuario" value="<?= $id_usuarioLogado; ?>">
            <input type="hidden" name="id_perfil" value="<?= $id_perfil; ?>">
            Poster do filme
            <input type="file" name="capa_filme" value="<?= $capa_filme; ?>"><br><br>
            Nome do filme:
            <input type="text" name="nome_filme" placeholder="Filme" value="<?= $nome_filme; ?>"> <br> <br>
            Data de lançamento:
            <input type="date" name="dt_de_lancamento_filme" placeholder="Data de lançamento" value="<?= $dt_de_lancamento_filme; ?>"><br><br>

            <label for="categoria_filme">Categoria:</label>
            <select name="fk_id_categoria_filme" id="categoria_filme">
                <option value="1" <?= ($fk_id_categoria_filme == 1) ? 'selected' : ''; ?>>Infantil</option>
                <option value="2" <?= ($fk_id_categoria_filme == 2) ? 'selected' : ''; ?>>Romance</option>
                <option value="3" <?= ($fk_id_categoria_filme == 3) ? 'selected' : ''; ?>>Ação</option>
                <option value="4" <?= ($fk_id_categoria_filme == 4) ? 'selected' : ''; ?>>Ficção</option>
                <option value="5" <?= ($fk_id_categoria_filme == 5) ? 'selected' : ''; ?>>Terror</option>
                <option value="6" <?= ($fk_id_categoria_filme == 6) ? 'selected' : ''; ?>>Comédia</option>
                <option value="7" <?= ($fk_id_categoria_filme == 7) ? 'selected' : ''; ?>>Drama</option>
                <option value="8" <?= ($fk_id_categoria_filme == 8) ? 'selected' : ''; ?>>Faroeste</option>
                <option value="9" <?= ($fk_id_categoria_filme == 9) ? 'selected' : ''; ?>>Suspense</option>
            </select>

            <label for="canal_filme">Canal:</label>
            <select name="fk_id_canal_filme" id="canal_filme">
                <option value="1" <?= ($fk_id_canal_filme == 1) ? 'selected' : ''; ?>>Netflix</option>
                <option value="2" <?= ($fk_id_canal_filme == 2) ? 'selected' : ''; ?>>Amazon Prime Video</option>
                <option value="3" <?= ($fk_id_canal_filme == 3) ? 'selected' : ''; ?>>Globoplay+</option>
                <option value="4" <?= ($fk_id_canal_filme == 4) ? 'selected' : ''; ?>>Disney+</option>
                <option value="5" <?= ($fk_id_canal_filme == 5) ? 'selected' : ''; ?>>Telecine</option>
                <option value="6" <?= ($fk_id_canal_filme == 6) ? 'selected' : ''; ?>>Now</option>
                <option value="7" <?= ($fk_id_canal_filme == 7) ? 'selected' : ''; ?>>Paramount+</option>
                <option value="8" <?= ($fk_id_canal_filme == 8) ? 'selected' : ''; ?>>HBO Max</option>
                <option value="9" <?= ($fk_id_canal_filme == 9) ? 'selected' : ''; ?>>Star+</option>
            </select>

            Duração:
            <input type="time" name="duracao_filme" placeholder="Duração" value="<?= $duracao_filme; ?>"> <br><br>
            Classificação indicativa:
            <input type="number" name="classificacao_filme" placeholder="Classificação" value="<?= $classificacao_filme; ?>"><br><br>
            
            Sinopse:
            <textarea name="sinopse_filme" id="" cols="30" rows="10" placeholder="Sinopse"><?= $sinopse_filme; ?></textarea><br>

            <input type="submit" value="Alterar">
        </form>
    </div>
    </center>
</body>

</html>