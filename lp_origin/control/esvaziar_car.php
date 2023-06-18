<?php
session_start();

require_once '../model/dto/carrinhoDTO.php';
require_once '../model/dao/carrinhoDAO.php';

$carrinhoDAO = new CarrinhoDAO();

if (isset($_SESSION['id_usuario']) && isset($_POST['carrinho_vazio'])) {
   
    $id_usuario = $_SESSION['id_usuario'];
    $id_item    = $_POST['id_item'];
    $id_perfil  = $_SESSION['id_perfil'];

    $carrinhoDTO = new CarrinhoDTO();
    $carrinhoDTO->setFk_id_usuario($id_usuario);
    $carrinhoDTO->setFk_id_perfil($id_perfil);
    $carrinhoDTO->setFk_id_item($id_item);

    $message = $carrinhoDAO->esvaziarCar($id_usuario);

    if ($message === 'Carrinho Vazio') {
        header('Location: ../view/carrinho.php');
        exit();
    } else {
        header("Location: ../view/todos_itens.php?msg=$message");
        exit;
    }
} else {
    header("Location:../view/todos_itens.php?msg=Usuário Não encontrado");
    exit;
}
