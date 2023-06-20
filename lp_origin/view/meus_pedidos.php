<?php
session_start();
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dao/compraDAO.php';
require_once '../model/dao/carrinhoDAO.php';

$itemDAO = new ItemDAO();
$usuarioDAO = new UsuarioDAO();
$compraDAO = new CompraDAO();
$carrinhoDAO = new carrinhoDAO();

if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
} else {
    $usuarioLogado = "";
    header("Location: ../view/todos_itens.php?msg=Usuário não encontrado");
    exit();
}

$compras = $compraDAO->obterComprasPorUsuario($id_usuarioLogado);

?>
<!DOCTYPE html>
<html lang="pt-br">
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
         $carrinhoData = $carrinhoDAO->countItemCarrinho($id_usuarioLogado);
         if (isset($carrinhoData['total_itens']) && isset($carrinhoData['carrinho_itens'])) {
               $total_itens = $carrinhoData['total_itens'];
               $carrinho_itens = $carrinhoData['carrinho_itens'];
               if (!empty($carrinho_itens)) {
                  echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>' . $total_itens . '</span></a>';
               } else {
                  echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>0</span></a>';
               }
         } else {
               echo '<a href="carrinho.php"><i class="fa-solid fa-cart-plus"></i>Carrinho<span>0</span></a>';
         }
         ?>
         <a href="../view/todos_itens.php" style="-i:2;"><i class="fa-solid fa-house"></i>Voltar</a>
      </nav>
   </header>
<section class="pedidos">
   <h1>Meus Pedidos</h1>
   <div class="pedido-container">
   <?php
      if(!empty($compras)) {
         foreach ($compras as $compra) {
            $item = $itemDAO->obterItemCarPorId($compra->getFk_id_item());
   ?>
   <div class="pedido-card" <?php if($compra->getStatus_compra() == 'Cancelada'){echo 'style="border:.2rem solid red";';}; ?>>
      <a href="pedido.php?id_item=<?= $compra->getId_compra()?>">
         <p class="date">
            <i class="fas fa-calendar"></i><span><?= $compra->getDt_hora_compra()?></span>
         </p>
         <img src="../assets/imagensprodutos/<?=$item->getImagem_item(); ?>" class="image">
         <h3><?= $item->getNome_item(); ?></h3>
         <p class="price"><i class="fas fa-brazilian-real-sign"></i> <?= $compra->getPreco_compra() ?> x <?= $compra->getQtd_compra()?></p>
         <p class="status"style="color:<?php if($compra->getStatus_compra() == 'Concluída'){
            echo 'green';
            }elseif($compra->getStatus_compra() == 'Cancelada'){echo 'red';
            }else{echo 'orange';
            }; 
         ?>">
         <?= $compra->getStatus_compra(); ?>
         </p>
      </a>
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