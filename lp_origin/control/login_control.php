<?php
session_start();

require_once '../model/conexao.php';
require_once '../model/dto/UsuarioDTO.php';
require_once '../model/dao/UsuarioDAO.php';


$email_usu = strip_tags($_POST["email_usu"]);
$senha_usu = $_POST["senha_usu"];

$UsuarioDAO    = new UsuarioDAO();
$usuarioLogado = $UsuarioDAO->logar($email_usu,$senha_usu);

//var_dump($UsuarioDAO);

if (!empty($usuarioLogado)) {
    $_SESSION['id_usuario']     = $usuarioLogado['id_usuario'];
    $_SESSION['nickname_usu']   = $usuarioLogado['nickname_usu'];
    $_SESSION['nome_usu']       = $usuarioLogado['nome_usu'];
    $_SESSION['fk_id_perfil']     = $usuarioLogado['fk_id_perfil'];
    
    if ($_SESSION['fk_id_perfil'] === 1) {
        header('Location:../view/adm/paineladmcomcss.php');
        exit();
    } elseif ($_SESSION['fk_id_perfil'] === 2) {
        header('Location:../moderador_usu.php');
        exit();
    } elseif ($_SESSION['fk_id_perfil'] === 4) {
        header('Location:../index.php');
        exit();
    }
}else {
    header("Location:../index.php?msg=Usuário e/ou senha inválidos");
    exit;
}

