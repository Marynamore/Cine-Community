<?php
session_start();

require_once '../model/dto/carrinhoDTO.php';
require_once '../model/dao/carrinhoDAO.php';

$carrinhoDTO = new CarrinhoDTO();
$carrinhoDAO = new CarrinhoDAO();

if (isset($_SESSION['id_usuario']) && isset($_POST['item_adicionado'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_perfil = $_SESSION['id_perfil'];

    $id_item = $_POST['id_item'];
    $qtd_compra = $_POST['qtd_item'];

    if (in_array($id_perfil, [3, 4])) {
        header('Location: ../view/todos_itens.php');
        exit();
    } elseif (in_array($id_perfil, [1])) {
        header('Location: ../view/dashboard/painel_adm.php');
        exit();
    }

    $carrinhoDTO->setFk_id_usuario($id_usuario);
    $carrinhoDTO->setFk_id_perfil($id_perfil);

    $message = $carrinhoDAO->adicionarItemCar($id_usuario, $id_item, $qtd_compra, $id_perfil);

    if ($message === 'Item Adicionado ao Carrinho') {
        header('Location: ../view/carrinho.php');
        exit();
    } else {
        header("Location: ../view/todos_itens.php?msg=$message");
        exit;
    }
} else {
    header("Location: ../view/todos_itens.php?msg=Usuário não encontrado");
    exit;
}
