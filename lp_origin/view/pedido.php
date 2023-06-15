<?php 
session_start();
require_once '../model/dao/compraDAO.php';
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/UsuarioDAO.php';

if (isset($_GET['id_item'])) {
    $id_item = $_GET['id_item'];
} else {
    $id_item = '';
    header('Location:todos_itens.php');
    exit();
}

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

if ($itemFetch) {
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        unset($_SESSION['msg']);
    } else {
        $message = "";
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
    $compras = $compraDAO->recuperaCompraId($id_item);

    if($compras){
        foreach ($compras as $compra) {
            $item = $compraDAO->selecionarItem($compra->getFk_id_item());

            $grand_total = 0;
            $sub_total = ($compraFetch['preco_compra'] * $compraFetch['quant_compra']);
            $grand_total += $sub_total;
   ?>
   <div>
      <div>
         <p class="title"><i class="fas fa-calendar"></i><?= $compraFetch['date']; ?></p>
         <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
         <p class="price"><i class="fas fa-brazilian-real-sign"></i><?= $compraFetch['price']; ?> x <?= $compraFetch['qty']; ?></p>
         <h3 class="name"><?= $fetch_product['name']; ?></h3>
         <p class="grand-total">grand total : <span><i class="fas fa-indian-rupee-sign"></i> <?= $grand_total; ?></span></p>
      </div>
      <div class="col">
         <p class="title">billing address</p>
         <p class="user"><i class="fas fa-user"></i><?= $compraFetch['name']; ?></p>
         <p class="user"><i class="fas fa-phone"></i><?= $compraFetch['number']; ?></p>
         <p class="user"><i class="fas fa-envelope"></i><?= $compraFetch['email']; ?></p>
         <p class="user"><i class="fas fa-map-marker-alt"></i><?= $compraFetch['address']; ?></p>
         <p class="title">status</p>
         <p class="status" style="color:<?php if($compraFetch['status'] == 'delivered'){echo 'green';}elseif($compraFetch['status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $compraFetch['status']; ?></p>
         <?php if($compraFetch['status'] == 'canceled'){ ?>
            <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">order again</a>
         <?php }else{ ?>
         <form action="" method="POST">
            <input type="submit" value="cancel order" name="cancel" class="delete-btn" onclick="return confirm('cancel this order?');">
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
<?php 
} else {
    echo '<p>Nenhum item encontrado!</p>';
}
?>