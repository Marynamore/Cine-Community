<?php
require_once "../model/dao/UsuarioDAO.php";
if (isset($_GET["id_usuario"])){
$id_usuario = $_GET["id_usuario"];
$UsuarioDAO = new UsuarioDAO();
$retorno = $UsuarioDAO->excluirUsuarioById($id_usuario);
$msg = ($retorno) ? "usuario excluído com sucesso!" : "Erro ao excluir o usuario";
} else {
    $msg = "ID do usuario não fornecido";
}

header("location:../view/dashboard/listausuarioadm.php?msg=" . urlencode($msg));
exit;

