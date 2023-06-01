<?php
require_once "../model/dao/ResenhaDAO.php";

if (isset($_GET["id_resenha"])) {
$id_resenha = $_GET["id_resenha"];
$ResenhaDAO = new ResenhaDAO();
$retorno = $ResenhaDAO->excluirResenhaById($id_resenha);
$msg = ($retorno) ? "Resenha excluído com sucesso!" : "Erro ao excluir a Resenha";
} else {
    $msg = "ID do Resenha não fornecido";
}

header("Location: ../view/filme_resenha.php?msg=" . urlencode($msg));


