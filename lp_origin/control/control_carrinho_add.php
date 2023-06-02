<?php
require_once '../model/dto/carrinhoDTO.php';
require_once '../model/dao/carrinhoDAO.php';

$carrinhoDAO = new CarrinhoDAO();

//session_start(); // Iniciar a sessão

if (isset($_SESSION['id_usuario']) && isset($_POST['item_adicionado'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_item = $_POST['id_item'];
    $qtd_compra = $_POST['qtd_item'];
    $id_perfil = 1; // Substitua o valor do ID do perfil pelo valor correto

    $message = $carrinhoDAO->adicionarItemCar($id_usuario, $id_item, $qtd_compra, $id_perfil);
} else {
    // Lógica para lidar com a ausência do id_usuario ou item_adicionado
    // Por exemplo, redirecionar para uma página de erro ou exibir uma mensagem de erro
   
}
header("Location:../view/carrinho.php ");  




