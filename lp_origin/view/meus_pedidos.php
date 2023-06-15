<?php
session_start();
require_once '../model/dao/itemDAO.php';
require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dao/compraDAO.php';

$itemDAO = new ItemDAO();
$usuarioDAO = new UsuarioDAO();
$compraDAO = new CompraDAO();

if (isset($_GET['id_item'])) {
    $id_item = $_GET['id_item'];
} else {
    $id_item = '';
    header('Location: ./todos_itens.php');
    exit();
}

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
   <h1>Meus Pedidos</h1>
   <div>
   <?php
    $compras = $compraDAO->obterIdUsuario($id_usuario);
 
      if($compras){
         foreach ($compras as $compra) {
            $item = $compraDAO->buscarItem($compra->getFk_id_item());
   ?>
   <div <?php if($compra->getStatus_compra() == 'Cancelada'){echo 'style="border:.2rem solid red";';}; ?>>
      <a href="pedido.php?id_item=<?= $compra->getId_compra()?>">
         <p><i class="fas fa-calendar"></i><span><?= $compra->getDt_hora_compra()?></span></p>
         <img src="../assets/imagensprodutos/<?=$item['imagem_item']; ?>">
         <h3><?= $item['nome_item']; ?></h3>
         <p><i class="fas fa-brazilian-real-sign"></i> <?= $compra->getPreco_compra() ?> x <?= $compra->getQuant_compra()?></p>
         <p style="color:<?php if($compraFetch['status_compra'] == 'Concluída'){echo 'green';}elseif($compraFetch['status_compra'] == 'Cancelada'){echo 'red';}else{echo 'orange';}; ?>"><?= $compraFetch['status_compra']; ?></p>
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

<?php 
} else {
    echo '<p>Nenhum item encontrado!</p>';
}
?>