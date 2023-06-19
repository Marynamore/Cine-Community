<?php
session_start();

require_once "../model/dao/itemDAO.php";

if (isset($_GET["id_item"])) {
    $id_item = $_GET["id_item"];
    $ItemDAO = new ItemDAO();
    $retorno = $ItemDAO->excluirItemPorId($id_item);
    $msg = ($retorno) ? "item excluído com sucesso!" : "Erro ao excluir o item";
} else {
    $msg = "ID do item não fornecido";
}

if ($_SESSION['id_perfil'] == 3) {
    header("Location: ../view/dashboard/listaitens.php?msg=" . urlencode($msg));
} else {
    header("Location: ../view/item.php?msg=" . urlencode($msg));
}
?>