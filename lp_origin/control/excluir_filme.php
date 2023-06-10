<?php
session_start();

require_once "../model/dao/filmeDAO.php";

if (isset($_GET["id_filme"])) {
    $id_filme = $_GET["id_filme"];
    $FilmeDAO = new FilmeDAO();
    $retorno = $FilmeDAO->excluirfilmeById($id_filme);
    $msg = ($retorno) ? "Filme excluído com sucesso!" : "Erro ao excluir o filme";
} else {
    $msg = "ID do filme não fornecido";
}

if ($_SESSION['id_perfil'] == 1) {
    header("Location: ../view/dashboard/painel_adm.php?msg=" . urlencode($msg));
} else if ($_SESSION['id_perfil'] == 2) {
    header("Location: ../view/dashboard/painel_moderador.php?msg=" . urlencode($msg));
} else {
    header("Location: ../view/Filme.php?msg=" . urlencode($msg));
}
?>