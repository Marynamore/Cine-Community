<?php
session_start();

require_once '../model/conexao.php';
require_once '../model/dto/UsuarioDTO.php';
require_once '../model/dao/UsuarioDAO.php';

$email_usu = strip_tags($_POST["email_usu"]);
$senha_usu = $_POST["senha_usu"];

$UsuarioDAO = new UsuarioDAO();
$usuarioLogado = $UsuarioDAO->logar($email_usu, $senha_usu);

if (!empty($usuarioLogado)) {
    $_SESSION['id_usuario'] = $usuarioLogado['id_usuario'];
    $_SESSION['nickname_usu'] = $usuarioLogado['nickname_usu'];
    $_SESSION['nome_usu'] = $usuarioLogado['nome_usu'];
    $_SESSION['id_perfil'] = $usuarioLogado['fk_id_perfil'];


    $id_perfil = $_SESSION['id_perfil'];

    if (in_array($id_perfil, [1])) {
        header("location:../view/dashboard/painel_adm.php?msg=success&action=login");
        exit;
    } elseif (in_array($id_perfil, [2])) {
        header("location:../view/dashboard/painel_moderador.php?msg=success&action=login");
        exit;
    } elseif (in_array($id_perfil, [3])){
        header("location:../view/dashboard/painel_colecionador.php?msg=success&action=login");
    } elseif (in_array($id_perfil, [4])){
        header("location:../index.php?msg=success&action=login");
        exit;
    }else{
        header("Location: ../view/cadastro.php?msg=warning&action=login");
        exit;
    }
} else {
    header("Location:../index.php?msg=error&action=login");
    exit;
}