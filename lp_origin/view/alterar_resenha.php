<?php
session_start();

if (isset($_SESSION["fk_id_usuario"])) {
    $id_usuarioLogado = $_SESSION["fk_id_usuario"];
    $id_perfil = $_SESSION["fk_id_perfil"];
} else {
    $usuarioLogado = "";
}

require_once '../model/dao/resenhaDAO.php';

$id_resenha = isset($_GET["id_resenha"]) ? $_GET["id_resenha"] : null;

if ($id_resenha) {
    $resenhaDAO = new ResenhaDAO();
    $resenha = $resenhaDAO->buscarPorID($id_resenha);

    if ($resenha) {
        // A resenha foi encontrada, preencha os campos do formulário com os valores correspondentes
        $id_resenha = $resenha->getId_resenha();
        $titulo_res = $resenha->getTitulo_res();
        $descricao_res = $resenha->getDescricao_res();
        $dt_hora_res = $resenha->getDt_hora_res();
        $fk_id_filme = $resenha->getFk_id_filme();
        $fk_id_usuario = $resenha->getFk_id_usuario();
        $fk_id_perfil = $resenha->getFk_id_perfil();
    } else {
        echo "Resenha não encontrada.";
        exit;
    }
} else {
    echo "ID da resenha não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form_resenhastyle.css">
    <title>Alterar Resenha</title>
    <script>
        function funcResenha() {
            alert("Resenha Alterada com sucesso!");
            return true; // Retorna true para permitir o envio do formulário
        }
    </script>
</head>

<body>
    <center>
        <section class="container">
            <h1>ALTERAR RESENHA</h1>
            <form action="../control/alterar_resenha.php" method="post">
                <br>
                <h2>TÍTULO</h2>
                <input type="text" name="titulo_res" class="titulo" value="<?= $titulo_res ?>">
                <div class="form">
                    <textarea name="descricao_res" cols="30" rows="10" placeholder="DEIXE AQUI SUA RESENHA"><?= $descricao_res ?></textarea>
                </div>
                <input type="hidden" name="dt_hora_res" value="<?= $dt_hora_res ?>">
                <input type="hidden" name="fk_id_filme" value="<?= $fk_id_filme ?>">
                <input type="hidden" name="fk_id_usuario" value="<?= $fk_id_usuario ?>">
                <input type="hidden" name="fk_id_perfil" value="<?= $fk_id_perfil ?>">
                <input type="hidden" name="id_resenha" value="<?= $id_resenha ?>">
                <input type="submit" onclick="return funcResenha()" value="ENVIAR" class="button">
                <a href="filme_resenha.php?get_id=<?= $get_id ?>" class="button">VOLTAR</a>
            </form>
        </section>
    </center>

    <?php
    if (isset($_GET['alterado']) && $_GET['alterado'] == 'true') {
        echo "<p>Resenha alterada com sucesso!</p>";
    }
    ?>
</body>
</html>
