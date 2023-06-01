<?php
session_start();

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form_resenhastyle.css">
    <title>Resenha</title>
    <script>
        function funcResenha() {
            alert("Resenha adicionada com sucesso!");
            return true; // Retorna true para permitir o envio do formulário
        }
    </script>
</head>

<body>
    <center>
        <section class="container">
            <h1>RESENHA</h1>
            <form action="../control/resenha_control.php" method="post">
                <br>
                <h2>TÍTULO</h2>
                <input type="text" name="titulo_res" class="titulo" required>
                <div class="form">
                    <textarea name="descricao_res" cols="30" rows="10" placeholder="DEIXE AQUI SUA RESENHA" required></textarea>
                </div>
                <input type="hidden" name="dt_hora_res" value="<?= date('Y-m-d H:i:s'); ?>">
                <input type="hidden" name="fk_id_filme" value="<?= $get_id; ?>">
                <input type="hidden" name="fk_id_usuario" value="<?= $_SESSION['fk_id_usuario']; ?>">
                <input type="hidden" name="fk_id_perfil" value="<?= $_SESSION['fk_id_perfil']; ?>">
                <input type="submit" onclick="return funcResenha()" value="ENVIAR" class="button">
                <a href="filme_resenha.php?get_id=<?= $get_id; ?>" class="button">VOLTAR</a>
            </form>
        </section>
    </center>
</body>
</html>