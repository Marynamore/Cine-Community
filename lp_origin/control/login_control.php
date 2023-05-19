<?php
session_start();
require_once __DIR__ . '/../model/dao/UsuarioDAO.php';
require_once __DIR__ . '/../model/dto/UsuarioDTO.php';

$email_usu = trim(filter_input(INPUT_POST, 'email_usu', FILTER_VALIDATE_EMAIL));
$senha_usu = trim(filter_input(INPUT_POST, 'senha_usu'));

$usuarioDTO = new UsuarioDTO();
$usuarioDTO->setEmail_usu($email_usu);
$usuarioDTO->setSenha_usu($senha_usu);

$usuarioDAO    = new UsuarioDAO();
$usuarioLogado = $usuarioDAO->logar($usuarioDTO);

if ($usuarioLogado !== null) {
    $_SESSION['id_usuario']     = $usuarioLogado->getId_usuario();
    $_SESSION['nickname_usu']   = $usuarioLogado->getNickname_usu();
    $_SESSION['perfil_usu']     = $usuarioLogado->getPerfil_usu();
    $_SESSION['nome_usu']       = $usuarioLogado->getNome_usu();
    
    if ($_SESSION['perfil_usu'] === 'administrador') {
        header('Location:../view/adm/paineladmcomcss.php');
        exit();
    } elseif ($_SESSION['perfil_usu'] === 'moderador') {
        header('Location:../moderador_usu.php');
        exit();
    } elseif ($_SESSION['perfil_usu'] === 'usuario') {
        header('Location:../usuariologado.php');
        exit();
    }
} else {
    header('Location:../view/login.php?msg=usuário e/ou senha inválidos');
    exit();
}
