<?php
session_start();
if ($_SESSION['id_perfil'] == 3 ) {
require_once "../model/dao/itemDAO.php";
require_once "../model/dto/itemDTO.php";

$id_item               = filter_input(INPUT_POST, 'id_item');
$nome_item             = filter_input(INPUT_POST, 'nome_item');
$imagem_item = filter_input(INPUT_POST, 'imagem_item');
$preco_item          = filter_input(INPUT_POST, 'preco_item');
$qtd_item          = filter_input(INPUT_POST, 'qtd_item');
$classificacao_item    = filter_input(INPUT_POST, 'classificacao_item');
$capa_item             = filter_input(INPUT_POST, 'capa_item');
$id_categoria_item     = isset($_POST['fk_id_categoria_item']) ? $_POST['fk_id_categoria_item'] : null;
$id_usuario             = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null;
$id_perfil              = isset($_POST['id_perfil']) ? $_POST['id_perfil'] : null;

    $itemDTO = new itemDTO();

var_dump($itemDTO);
    $itemDTO->setId_item($id_item);
    $itemDTO->setNome_item($nome_item);
    $itemDTO->setImagem_item($imagem_item);
    $itemDTO->setPreco_item($preco_item);
    $itemDTO->setQtd_item($qtd_item);
    $itemDTO->setFk_id_categoria_item($id_categoria_item);
    $itemDTO->setFk_id_usuario($id_usuario);
    $itemDTO->setFk_id_perfil($id_perfil);
    
    $itemDAO = new itemDAO();
    $success = $itemDAO->alterarItem($itemDTO);

    if ($success) {
        $msg = "item alterado com sucesso!";
    } else {
        $msg = "Erro ao alterar o item";
    }
    
//     if ($_SESSION['id_perfil'] == 3) {
//         header("Location: ../view/dashboard/listaitens.php?msg=" . urlencode($msg));
//  } else {
//     $msg = "Permissão negada para alterar o item";
//     header("Location: ../view/dashboard/pagina_de_erro.php?msg=" . urlencode($msg));
//  }
}
?>