<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/stylelista.css">
    <title>Lista Administrador</title>
</head>
<body>
<?php
   require_once '../../model/dao/filmeDAO.php';

   $FilmeDAO = new FilmeDAO();
   $filme = $FilmeDAO->listarFilmesComCategoria();

?>
 <a href="../adm/paineladmcomcss.php">Voltar</a> 
      <center> <h2>Lista de Filmes</h2></center>
    <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Lançamento</th>
            <th>Duração</th>
            <th>Categoria</th>
            <th>Classificação</th>
            <th>Capa</th>
            <th>Trailer</th>
            <th>Canal</th>
            <th>Ação</th>

          </tr>
        </thead>
        <tbody>
          <tr>
          <?php
              foreach($filme as $filmeFetch){
          ?>
          <tr>
            <td><?=$filmeFetch["id_filme"]?></td>
            <td><?=$filmeFetch["nome_filme"]?></td>
            <td><?=$filmeFetch["dt_de_lancamento_filme"] ?></td>
            <td><?=$filmeFetch["duracao_filme"]?></td>
            <td><?=$filmeFetch["categoria_filme"]?></td>
            <td><?=$filmeFetch["classificacao_filme"] ?></td>
            <td><?=$filmeFetch["capa_filme"]?></td>
            <td><?=$filmeFetch["trailer_usu"]?></td>
            <td><?=$filmeFetch["canal_filme"]?></td>
           
            <td>
              <button class="editar"><a href="./alterar_filme.php?get_id=<?=$filme["id_filme"]?>"title="ALTERAR" class="editar"> Alterar<i class="bi bi-pencil"></i></a></button>
              <button class="excluir"><a href="./excluir.php?get_id=<?=$filme["id_filme"]?>" title="EXCLUIR">Excluir<i class="fa fa-trash fa-lg"></i></a></button>
            </td>
          </tr>
          <?php
            }
          ?>

</body>
<!--<td><?=$filmeFetch["sinopse_filme"]?></td>
<th>Sinopse</th>-->
</html>