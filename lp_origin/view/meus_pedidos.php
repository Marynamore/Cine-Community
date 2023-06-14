<?php
session_start();

require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dao/compraDAO.php';

$usuarioDAO = new UsuarioDAO();
$compraDAO = new CompraDAO();

if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
    $id_perfil = $_SESSION["id_perfil"];
    $id_usuario = $_SESSION["id_usuario"];

    $usuario = $usuarioDAO->encontraPorId($id);
} else {
    echo "Usuário não encontrado.";
    exit;
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
   
<?php include 'components/header.php'; ?>

<section class="orders">

   <h1 class="heading">my orders</h1>

   <div class="box-container">

   <?php
    $compraFetch = $compraDAO->obterIdUsuario($id_usuario);
      if($compraFetch){
        
         while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_product->execute([$fetch_order['product_id']]);
            if($select_product->rowCount() > 0){
               while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" <?php if($fetch_order['status'] == 'canceled'){echo 'style="border:.2rem solid red";';}; ?>>
      <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
         <p class="date"><i class="fa fa-calendar"></i><span><?= $fetch_order['date']; ?></span></p>
         <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
         <h3 class="name"><?= $fetch_product['name']; ?></h3>
         <p class="price"><i class="fas fa-indian-rupee-sign"></i> <?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p>
         <p class="status" style="color:<?php if($fetch_order['status'] == 'delivered'){echo 'green';}elseif($fetch_order['status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $fetch_order['status']; ?></p>
      </a>
   </div>
   <?php
            }
         }
      }
   }else{
      echo '<p class="empty">no orders found!</p>';
   }
   ?>

   </div>

</section>














<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>