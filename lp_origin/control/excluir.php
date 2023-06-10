<?php
session_start();
require_once "../model/dao/UsuarioDAO.php";
if (isset($_GET["id_usuario"])){
$id_usuario = $_GET["id_usuario"];
$UsuarioDAO = new UsuarioDAO();
$retorno = $UsuarioDAO->excluirUsuarioById($id_usuario);
$msg = ($retorno) ? "usuario excluído com sucesso!" : "Erro ao excluir o usuario";
} else {
    $msg = "ID do usuario não fornecido";
}
if ($_SESSION['id_perfil'] == 1) {
    header("Location: ../view/dashboard/painel_adm.php?msg=" . urlencode($msg));
} else if ($_SESSION['id_perfil'] == 4) {
    header("Location: ../index.php?msg=" . urlencode($msg));
} else {
    header("Location: ../view/Filme.php?msg=" . urlencode($msg));
}
?>