<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/stylelista.css">
    <title>Lista Usuários</title>
</head>
<body>
<?php

   require_once '../../model/dao/UsuarioDAO.php';
   $UsuarioDAO = new UsuarioDAO();

?>
<a href="../adm/paineladmcomcss.php">Voltar</a>
   <center> <h2>Lista de Usuários</h2></center>
    <?php
      if(isset($_GET["msg"])){
        echo "<center>".$_GET["msg"]."</center>";
      }
    ?>
    <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Nickname</th>
            <th>Data de Nascimento</th>
            <th>Gênero</th>
            <th>E-mail</th>
            <th>Senha</th>
            <th>Foto</th>
            <th>Ação</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $usuario = $UsuarioDAO->listarTodos();
              foreach($usuario as $usuario){
            ?>
            <td><?=$usuario["id_usuario"]?></td>
            <td><?=$usuario["nome_usu"]?></td>
            <td><?=$usuario["nickname_usu"] ?></td>
            <td><?=$usuario["genero_usu"] ?></td>
            <td><?=$usuario["dt_de_nasci_usu"]?></td>
            <td><?=$usuario["email_usu"]?></td>
            <td><?=$usuario["senha_usu"]?></td>
            <td><?=$usuario["foto_usu"]?></td>
            <td>
              <button class="editar"><a href="../alterar_usuario.php?id=<?=$usuario["id_usuario"]?>"title="ALTERAR"> Alterar<i class="bi bi-pencil"></i></a></button>
              <button class="excluir"><a href="../control/excluir.php?id=<?=$usuario["id_usuario"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a></button>
            </td>
          </tr>
          <?php
            }
          ?>
          <!-- adicione mais linhas conforme necessário -->
        </tbody>
      </table>


</body>
</html>