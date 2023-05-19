<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylelista.css">
    <title>Lista Filmes</title>
</head>
<body class="tudo" >
<?php

   require_once '../model/dao/filmeDAO.php';
   $FilmeDAO = new FilmeDAO();
   $filme = $FilmeDAO->listarTodos();

?>
    <header>
      <center class="cabecalho">
          Lista de filmes <br><br>
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
              <td>Data de lançamento</td>
              <td>Classificação</td>
              <td>Gênero</td>
              <td>Duração</td>
              <td>Sinopse</td>
              <td>Capa</td>
              <td>Canal</td>             
              <td>Editar</td>
            </tr>
            <tr class="tabela">
            <?php
                foreach($filme as $filme ){
            ?>
            <tr>
                <td><?php echo $filme["id_filme"]?></td>
                <td><?=$filme["nome_filme"]?></td>
                <td><?=$filme["dt_de_lancamento_filme"] ?></td>
                <td><?=$filme["classificacao_filme"] ?></td>
                <td><?=$filme["genero_filme"]?></td>
                <td><?=$filme["duracao_filme"]?></td>
                <td><?=$filme["sinopse_filme"]?></td>
                <td><?=$filme["capa_filme"]?></td>
                <td><?=$filme["canal_filme"]?></td>
                <td>
                    <a href="./alterar_filme.php?id=<?=$filme["id_filme"]?>"title="ALTERAR"> Alterar<i class="bi bi-pencil"></i></a>
                    <a href="./excluir.php?id=<?=$filme["id_filme"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a>
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