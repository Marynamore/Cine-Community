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
$usuarioFetch = $usuarioDAO->dadosUsuarioPorId($id_perfil);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="../css/pedidos.css">

</head>
<body>
   <header class="header">
      <a href="index.php" class="logo"><img src="../assets/logoinicio.png" alt="index.php"></a>
      <nav class="navbar" style="-i:1;">
         <a href="./view/alterar_usuario.php?id_usuario=<?= $id_usuarioLogado?>" onclick="funcPerfil()"><i class="fa-solid fa-user"></i><?= $_SESSION["nickname_usu"]; ?></a>
         <?php
         if (isset($carrinhoData['total_itens']) && isset($carrinhoData['carrinho_itens'])) {
            // echo '';
            // print_r($carrinhoData['total_itens']) && isset($carrinhoData['carrinho_itens']);
            // echo '';
            $total_itens = $carrinhoData['total_itens'];
            $carrinho_itens = $carrinhoData['carrinho_itens'];
            if (!empty($carrinho_itens)) {
               foreach ($carrinho_itens as $carrinhoItem) {
                  echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>' . $total_itens . '</span></a>';
               }
            }
         } else {
               echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>0</span></a>';
         }
         ?>
         <a href="../view/todos_itens.php" style="-i:2;"><i class="fa-solid fa-house"></i>Voltar</a>
      </nav>
   </header>
<section class="detalhe-pedido">
   <h1>Detalhe Pedido</h1>
   <div class="pedido-container">
   <?php
   $total_itens = 0;
   $compras = $compraDAO->recuperaCompraId($id_item);
    if($compras){
        foreach ($compras as $compraFetch) {
            $itemFetch = $itemDAO->obterItemPorId($compraFetch['fk_id_item']);
            $sub_total = ($compraFetch['preco_compra'] * $compraFetch['qtd_compra']);
            $total_itens += $sub_total;
   ?>
   <div class="pedido-card">
        <div class="col">
            <p><i class="fas fa-calendar"></i><?= $compraFetch['dt_hora_compra']; ?></p>
            <img src="../assets/imagensprodutos/<?= $itemFetch->getImagem_item()?>" class="image">
            <p class="price"><i class="fas fa-brazilian-real-sign"></i><?= $compraFetch['preco_compra']; ?> x <?= $compraFetch['qtd_compra']?></p>
            <h3><?= $itemFetch->getNome_item(); ?></h3>
            <p class="grand-total">Valor Total : <span><i class="fas fa-brazilian-real-sign"></i><?= $total_itens?></span></p>
        </div>
      <div class="col">
         <h2>Informações do Colecionador</h2>
         <p class="user"><i class="fas fa-user"></i><?= $usuarioFetch['nome_usu']?></p>
         <p class="user"><i class="fas fa-phone"></i><?= $usuarioFetch['telefone']?></p>
         <p class="user"><i class="fas fa-envelope"></i><?= $usuarioFetch['email_usu']?></p>
         <p class="user"><i class="fas fa-map-marker-alt"></i><?= $usuarioFetch['endereco']?></p>
         <p>STATUS</p>
         <p class="status" style="color:<?php if($compraFetch['status_compra'] == 'Concluída'){echo 'green';}elseif($compraFetch['status_compra'] == 'Cancelada'){echo 'red';}else{echo 'orange';}; ?>"><?= $compraFetch['status_compra']; ?></p>
         <?php if($compraFetch['status_compra'] == 'Cancelada'){ ?>
            <a href="transacao.php?id_item=<?= $itemFetch->getId_item(); ?>" class="btn">Comprar Novamente</a>
         <?php }else{ ?>
         <form action="cancelar_pedido_action.php" method="POST">
            <input type="submit" value="Cancelar Pedido" name="cancelar_pedido" onclick="return confirm('Deseja cancelar o pedido?')" class="alterar_input">
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