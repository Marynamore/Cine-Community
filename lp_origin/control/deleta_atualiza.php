<?php
session_start();

require_once '../model/dto/carrinhoDTO.php';
require_once '../model/dao/carrinhoDAO.php';

$carrinhoDAO = new CarrinhoDAO();

if (isset($_SESSION['id_usuario'])) {
   $id_usuario = $_SESSION['id_usuario'];
   $id_item    = $_POST['id_item'];
   $qtd_compra = $_POST['qtd_compra'];
   $id_perfil  = $_SESSION['id_perfil'];
   $preco      = $_POST['preco_item'];
   $id_carrinho = $_POST['id_carrinho'];

   if (isset($_POST['atualizar_car'])) {

      $messagem = $carrinhoDAO->altualizarQtdCar($id_carrinho, $qtd_compra);

      if ($message === 'Quantidade atualizada no carrinho!') {
         header('Location: ../view/carrinho.php');
         exit();
      } else {
         header("Location: ../view/carrinho.php?msg=$message");
         exit;
      }
   } elseif (isset($_POST['deletar_item'])) {

      $messagem = $carrinhoDAO->excluirItemCar($id_carrinho);

      if ($message === 'Item excluído do Carrinho!') {
        header('Location: ../view/carrinho.php');
        exit();
      } else {
         header("Location: ../view/carrinho.php?msg=$message");
         exit;
      }
   }
} else {
    header("Location: todos_itens.php?msg=Seu carrinho está vazio");
    exit;

}
