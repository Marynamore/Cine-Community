<?php
require_once '../model/dto/carrinhoDTO.php';
require_once '../model/dao/carrinhoDAO.php';

$carrinhoDTO = new CarrinhoDTO();
$carrinhoDAO = new CarrinhoDAO();


if (isset($usuarioLogado) && isset($_POST['item_adicionado'])) {
    session_start();
    $_SESSION['id_usuario'] = $usuarioLogado['id_usuario'];
    $_SESSION['id_perfil'] = $usuarioLogado['fk_id_perfil'];

    $id_usuario  = $_SESSION['id_usuario'];
    $id_item = $_POST['id_item'];
    $qtd_compra = $_POST['qtd_item'];
    $id_perfil = $_SESSION['id_perfil'];

    if (in_array($id_perfil, [3, 4])) {
        header('Location:../view/todos_itens.php');
        exit();
    } elseif(in_array($id_perfil, [1])) {
        header('Location:../view/dashboard/painel_adm.php');
        exit();
    }
    $carrinhoDTO->setFk_id_usuario($id_usuario);
    $carrinhoDTO->setFk_id_perfil($id_perfil);

    $message = $carrinhoDAO->adicionarItemCar($id_usuarioLogado, $id_item, $qtd_compra, $id_perfil);
    
} else {
    header("Location:../view/todos_itens.php?msg=Usuário Não encontrado");
    exit;
}


