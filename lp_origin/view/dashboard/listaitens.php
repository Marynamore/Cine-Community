<?php
session_start();

$usuarioLogado = $_SESSION["nickname_usu"];
$id_usuarioLogado = $_SESSION["id_usuario"];
$id_perfil = $_SESSION["id_perfil"];

if ($id_perfil == "colecionador") {
    echo "Apenas colecionador podem acessar essa pagina.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/stylelista.css">
    <title>Lista Colecionador</title>
</head>
<body>
<?php
   require_once '../../model/dao/ItemDAO.php';

   $ItemDAO = new ItemDAO();
   $itens = $ItemDAO->listarTodosItens();

?>
 <a href="../dashboard/painel_colecionador.php">Voltar</a> 
      <center> <h2>Lista de Itens</h2></center>
    <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade de Itens</th>
            <th>Categoria</th>
            <th>Capa</th>
            <th>Ação</th>

          </tr>
        </thead>
        <tbody>
          <tr>
          <?php
              foreach($itens as $itemFetch){
          ?>
          <tr>
            <td><?=$itemFetch["id_item"]?></td>
            <td><?=$itemFetch["nome_item"]?></td>
            <td><?=$itemFetch["preco_item"] ?></td>
            <td><?=$itemFetch["qtd_item"]?></td>
            <td><?=$itemFetch["categoria_item"]?></td>
            <td><?=$itemFetch["imagem_item"] ?></td>
           
            <td>
              <button class="editar"><a href="../alterar_itens.php?id=<?=$itemFetch["id_item"]?>"title="ALTERAR" class="editar"> Alterar<i class="bi bi-pencil"></i></a></button>
              <button class="excluir"><a href="../../control/excluir_item.php?id_item=<?=$itemFetch["id_item"]?>"title="EXCLUIR"><i class="fa fa-trash fa-lg"></i> Excluir</a></button>


            </td>
          </tr>
          <?php
            }
          ?>

</body>
<!--<td><?=$itemFetch["sinopse_itens"]?></td>
<th>Sinopse</th>-->
</html>