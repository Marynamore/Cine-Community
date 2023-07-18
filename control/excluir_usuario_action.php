<?php
session_start();

require_once "../model/dao/UsuarioDAO.php";

if (isset($_GET["id_usuario"])) {
    $id_usuario = $_GET["id_usuario"];

    $UsuarioDAO = new UsuarioDAO();
    $retorno = $UsuarioDAO->excluirUsuarioById($id_usuario);
    
    if ($retorno) {

        $id_perfil = $_SESSION["id_perfil"];
        session_unset();

        if(in_array($id_perfil,[1])){
            header("Location: ../view/dashboard/painel_adm.php?msg=success&action=excluir");
            exit;
        } elseif (in_array($id_perfil,[2])) {
            header("Location: ../view/dashboard/painel_moderador.php?msg=success&action=excluir");
            exit;
        } elseif (in_array($id_perfil,[3])) {
            header("Location: ../view/dashboard/painel_colecionador.php?msg=success&action=excluir");
        } elseif (in_array($id_perfil,[4])) {
            header("Location: ../index.php?msg=success&action=excluir");
        }
    }
} else {
// Redirecionar para a página do administrador com mensagem de erro
header("location:../view/dashboard_adm.php?msg=error&action=excluir");
}  