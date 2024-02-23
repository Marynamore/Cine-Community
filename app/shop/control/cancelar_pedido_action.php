<?php
session_start();

require_once '../model/dto/compraDTO.php';
require_once '../model/dao/compraDAO.php';

$compraDAO = new CompraDAO();

if (isset($_SESSION['id_usuario']) && isset($_POST['cancelar_pedido'])) {

   $id_usuario = $_SESSION['id_usuario'];
   $id_item    = $_POST['id_item'];
   $id_perfil  = $_SESSION['id_perfil'];
   $status_compra = $_POST['Cancelada'];

   $compraDTO = new CompraDTO();
   $compraDTO->setFk_id_usuario($id_usuario);
   $compraDTO->setFk_id_perfil($id_perfil);
   $compraDTO->setFk_id_item($id_item);

   $message = $compraDAO->CancelarPedido($id_item,$id_usuario);

   if ($message === 'Cancelada') {
      header('Location: meus_pedidos.php');
      exit();
   } else {
      header("Location: todos_itens.php?msg=$message");
      exit;
   }
} else {
    header("Location: todos_itens.php?msg=Usuário Não encontrado");
    exit;
}