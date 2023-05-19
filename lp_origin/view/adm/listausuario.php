<?php 
    session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylelista.css">
    <title>Lista usuario</title>
</head>
<body class="tudo" >
    
    <header class="header" >
        <a href="../index.html" class="logo"><img src="assets/logoinicio.png" alt=""></a>
        <nav class="navbar" style="-i:1;">
            <a href="#" style="-i:2;"><i class="fa-solid fa-house"></i><br>INICIO</a>
            <a href="login.php" style="-i:4;"><i class="fa-solid fa-user"><br><?=$_SESSION['nome_usu'];?></i></a>
            <a href="./pages/alterar_usuario.php"><i class="fa-solid fa-comment-dots"></i><br>COMENTÁRIOS</a>
            <a href="./pages/listausuario.php"><i class="fa-solid fa-users"></i><br>SOBRE NÓS</a>
        </nav>
    </header>
<?php

   require_once '../model/dao/UsuarioDAO.php';
   $UsuarioDAO = new UsuarioDAO();
   $usuario = $UsuarioDAO->listarTodos();

?>
    <header>
      <center class="cabecalho">
          Lista de usuario <br><br>
          </center>
          <?php
            if(isset($_GET["msg"])){
                echo "<center>".$_GET["msg"]."</center>";
            }
        ?>
    </header>
    <center><main>
        <table border="1">
            <tr class="tabela">
              <td>ID</td>  
              <td>Nome</td>
              <td>Nickname</td>
              <td>Gênero</td>
              <td>Data de nascimento</td>
              <td>Email</td>
              <td>Senha</td>                   
              <td>Ação</td>
            </tr>
            <tr class="tabela">
            <?php
                foreach($usuario as $usuario ){
            ?>
            <tr>
                <td><?php echo $usuario["id_usuario"]?></td>
                <td><?=$usuario["nome_usu"]?></td>
                <td><?=$usuario["nickname_usu"] ?></td>
                <td><?=$usuario["genero_usu"] ?></td>
                <td><?=$usuario["dt_de_nasci_usu"]?></td>
                <td><?=$usuario["email_usu"]?></td>
                <td><?=$usuario["senha_usu"]?></td>
                <td>
                    <a href="../alterar_usuario.php?id<?=$usuario["id_usuario"]?>"title="ALTERAR"> Alterar<i class="bi bi-pencil"></i></a>
                    <a href="../../control/excluir.php?id=<?=$usuario["id_usuario"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a>
            </td>
            </td>
            </tr>
            <?php
                }
            ?>
        </table>
        <a href="../usu_logado.php">Voltar</a> 
    </main>
</center>
</body>
</html>