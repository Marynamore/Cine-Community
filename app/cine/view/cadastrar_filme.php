<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || !isset($_SESSION["id_perfil"])) {
    header("Location: login.php"); // Redirecionar para a página de login, caso o usuário não esteja logado
    exit;
}

$id_usuario = $_SESSION["id_usuario"];
$id_perfil = $_SESSION["id_perfil"];

if ($id_perfil == "moderador") {
    echo "Apenas moderadores e podem cadastrar filmes.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    </head>
    <title>Cadastrar filme</title>
<body>
<a href="../view/dashboard/painel_moderador.php"><input type="submit" value="Voltar"></a>
<h1>Cadastrar filme</h1>
<div class="container">
    <form action="../control/cadastro_filme_action.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="fk_id_usuario" value="<?= $id_usuario; ?>">
        <input type="hidden" name="fk_id_perfil" value="<?= $id_perfil; ?>">
        <fieldset>
             
            <label for="capa_filme"> <strong> Poster do filme:</strong></label>
            <input type="file" name="capa_filme" id="capa_filme" placeholder="Foto" required>

            <label for="nome_filme"><strong>Nome do filme:</strong></label>
            <input type="text" name="nome_filme" id="nome_filme" placeholder="Filme" required>

            <label for="dt_de_lancamento_filme"><strong>Data de lançamento:</strong></label>
            <input type="date" name="dt_de_lancamento_filme" id="dt_de_lancamento_filme" placeholder="Data de lançamento" required>

            <label for="fk_id_categoria_filme"><strong>Categoria:</strong></label>
            <select name="fk_id_categoria_filme" id="fk_id_categoria_filme" required>
                <option value=""><strong>Selecionar uma Categoria</strong></option>
                <option value="1">Infantil</option>
                <option value="2">Romance</option>
                <option value="3">Ação</option>
                <option value="4">Ficção</option>
                <option value="5">Terror</option>
                <option value="6">Comédia</option>
                <option value="7">Drama</option>
                <option value="8">Faroeste</option>
                <option value="9">Suspense</option>
            </select>

            <label for="fk_id_canal_filme"><strong>Canal:</strong></label>
            <select name="fk_id_canal_filme" id="fk_id_canal_filme" required>
                <option value="">Selecionar um Canal</option>
                <option value="1">Netflix</option>
                <option value="2">Amazon Prime Video</option>
                <option value="3">Globoplay+</option>
                <option value="4">Disney+</option>
                <option value="5">Telecine</option>
                <option value="6">Now</option>
                <option value="7">Paramount+</option>
                <option value="8">HBO Max</option>
                <option value="9">Star+</option>
            </select>

            <label for="duracao_filme"><strong>Duração:</strong></label>
            <input type="time" name="duracao_filme" id="duracao_filme" placeholder="Duração" required>

            <label for="classificacao_filme"><strong>Classificação indicativa:</strong></label>
            <input type="number" name="classificacao_filme" id="classificacao_filme" placeholder="Classificação" required>

            <label for="sinopse_filme"><strong>Sinopse:</strong></label>
            <textarea name="sinopse_filme" id="sinopse_filme" cols="30" rows="10" placeholder="Sinopse" required></textarea>
        </fieldset>
        
        <input type="submit" value="Cadastrar">
    </form>
</div>
</body>
</html>