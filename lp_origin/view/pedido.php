<?php 
session_start();
require_once '../model/dao/compraDAO.php';
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/UsuarioDAO.php';

$itemDAO = new ItemDAO();
$compraDAO = new CompraDAO();
$usuarioDAO = new UsuarioDAO();

if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $usuarioLogado = "";
    header("Location: ../view/todos_itens.php?msg=Usuário não encontrado");
    exit();
}

if (isset($_GET['id_item'])) {
    $id_item = $_GET['id_item'];
} else {
    $id_item = '';
    header('Location: meus_pedidos.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/perfil_usuario.css">

</head>
<body>
<section>
   <h1>Detalhe Pedido</h1>
   <div>
   <?php
   $total_itens = 0;
    $compras = $compraDAO->recuperaCompraId($id_item);

    if($compras){
        foreach ($compras as $compra) {
            $item = $compraDAO->selecionarItem($compra->getFk_id_item());

            $sub_total = ($compraFetch['preco_compra'] * $compraFetch['quant_compra']);
            $total_itens += $sub_total;
   ?>
   <div>
        <div>
            <p><i class="fas fa-calendar"></i><?= $compraFetch['dt_hora_compra']; ?></p>
            <img src="../assets/imagensprodutos/<?= $itemFetch['imagem_item']?>">
            <p><i class="fas fa-brazilian-real-sign"></i><?= $compraFetch['preco_compra']; ?> x <?= $compraFetch['quant_compra']?></p>
            <h3><?= $itemFetch['nome_item']; ?></h3>
            <p>Valor Total : <span><i class="fas fa-brazilian-real-sign"></i><?= $total_itens?></span></p>
        </div>
      <div>
         <p>Informações do Colecionador</p>
         <p><i class="fas fa-user"></i><?= $usuarioFetch['nome_usu']?></p>
         <p><i class="fas fa-phone"></i><?= $usuarioFetch['telefone']?></p>
         <p><i class="fas fa-envelope"></i><?= $usuarioFetch['email_usu']?></p>
         <p><i class="fas fa-map-marker-alt"></i><?= $usuarioFetch['endereco']?></p>
         <p>STATUS</p>
         <p style="color:<?php if($compraFetch['status_compra'] == 'Concluída'){echo 'green';}elseif($compraFetch['status_compra'] == 'Cancelada'){echo 'red';}else{echo 'orange';}; ?>"><?= $compraFetch['status_compra']; ?></p>
         <?php if($compraFetch['status_compra'] == 'Cancelada'){ ?>
            <a href="transacao.php?id_item=<?= $itemFetch['id_item']; ?>" class="btn">Comprar Novamente</a>
         <?php }else{ ?>
         <form action="cancelar_pedido.php" method="POST">
            <input type="submit" value="Cancelar Pedido" name="cancelar_pedido" onclick="return confirm('Deseja cancelar o pedido?')">
         </form>
         <?php } ?>
      </div>
   </div>
    <?php
        }
        }else{
         echo '<p>Nenhum Pedido adicionado</p>';
      }
    ?>

   </div>

</section>

</body>
</html>