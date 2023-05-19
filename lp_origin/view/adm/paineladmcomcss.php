<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styleadm.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Lista Administrador</title>
</head>
<body>
<header class="header" >
        <a href="../../index.php" class="logo"><img src="../../assets/logoinicio.png" alt="index.php"></a>
        <nav class="navbar" style="-i:1;">
            <a href="../../index.php" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>

        </nav>
    </header>
<header>

        <h1>Painel de Administração</h1>
    </header>
    <nav>
        <div class='painel_adm'>
            <a href="../adm/listausuarioadm.php">Usuários</a>
            <a href="../adm/listafilmesadm.php">Filmes</a>
			<a href="#">Configurações</a>
			<a href="../../control/control_sairadm.php">Logout</a>
    </div>

    </nav>
    <main>
        <center><p><h2>Olá, <?php echo $_SESSION["perfil_usu"]; ?>!</h2></p></center>


</body>
</html>
