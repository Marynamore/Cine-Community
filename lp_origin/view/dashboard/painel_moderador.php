<?php
session_start();
require_once '../../model/dao/UsuarioDAO.php';
$UsuarioDAO = new UsuarioDAO();
$idUsuarioDesejado = 2; // Substitua o número pelo ID desejado
$usuario = $UsuarioDAO->recuperarUsuarioPorID($idUsuarioDesejado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styleadm.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Lista Moderador</title>
</head>
<body>
    <header class="header">
        <a href="../../index.php" class="logo"><img src="../../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="../../index.php" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
        </nav>
    </header>
    <header>
        <h1>Painel do Moderador</h1>
    </header>
    <nav>
        <div class='painel_adm'>
            <a href="../../index.php">voltar</a>
            <a href="../dashboard/listafilmemod.php">Filmes</a>
            <?php if ($usuario): ?>
                <a href="../cadastrar_filme.php?id_usuario=<?= $usuario["id_usuario"] ?>">Adicionar Filme</a>
                <a href="../perfil_usuario.php?id_usuario=<?= $usuario["id_usuario"] ?>">Perfil</a>
            <?php endif; ?>
        </div>
    </nav>
    <main>
        <center><p><h2>Olá, <?php echo $_SESSION["nome_usu"]; ?>!</h2></p></center>
    </main>
</body>
</html>